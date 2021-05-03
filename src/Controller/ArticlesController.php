<?php

namespace App\Controller;
use App\Entity\Articles;
use App\Entity\PhotoManager;
use App\Form\ArticlesType;
use App\Repository\PhotoManagerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Repository\ArticlesRepository;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/add_articles", name="add_articles")
     */
    public function add_articles(): Response
    {
        $articles = new Articles();
        $form = $this->createForm(ArticlesType::class, $articles);
        $em = $this->getDoctrine()->getManager();
        $forRender['title'] = 'Форма создания статьи';
        $forRender['form'] = $form->createView();
        return $this->render('add_articles.html.twig', $forRender);
    }
    /**
     * @Route("/save_articles", name="save_articles")
     */
    public function save_articles(Request $request): Response
    {
        try{
            $articles = new Articles();
            //Если не заполнены основые данные то выдает ошибку
            $article = $request->get('articles');
            if (empty($article['title'])
                || empty($article['text'])
                || is_null($request->files->get('articles'))

            ){
                throw new \Exception();
            }

            $articles->setTitle($article['title']);
            $articles->setText($article['text']);
            if (!empty($article['category'])){
                $articles->setСategory($article['category']);
            }

            $articles->setPictureId($this->upload($request));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articles);
            $entityManager->flush();

            $data = [
                'status' => 200,
                'success' => "Articles added successfully",
            ];
            return $this->response($data);
        }catch (\Exception $e){
            $data = [
                'status' => 422,
                'errors' => "Data no valid",
            ];
            return $this->response($data, 422);
        }
    }
    //Сохраняет файл и возвращает id
    public function upload($request)
    {
        $file = $request->files->get('articles')['picture'];
        $path = 'uploads/Articles/picture';
        $name = $request->files->get('articles')['picture']->getClientOriginalName();
        $file->move($path,$name);

        $photoManager = new PhotoManager();
        $photoManager->setPhotoName($name);
        $photoManager->setPhotoPath('/uploads/Articles/picture'.$name);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($photoManager);
        $entityManager->flush();

        return $photoManager->getId();
    }
    public function response($data, $status = 200, $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }
    /**
     * @Route("/get_articles", name="get_articles")
     */
    public function get_articles(Request $request, ArticlesRepository $ar, PhotoManagerRepository $pmr): Response
    {
        try{
            $a = json_decode($request->getContent(), true);
            $lastQuestion = $ar->findBy(
                ['deleted'=>'0','category' => $a['category']],
                ['id' => 'asc'], 5);
            $requestArray = [];
            foreach ($lastQuestion as $key => $val){
                $requestArray[$val->getId()] = [];
                $requestArray[$val->getId()]['picture_href'] = $val->getPictureHref($pmr);
                $requestArray[$val->getId()]['text'] = $val->getText();
                $requestArray[$val->getId()]['title'] = $val->getTitle();
            }

            $data = [
                'status' => 200,
                'records' => json_encode($requestArray),
            ];
            return $this->response($data);
        }catch (\Exception $e){
            $data = [
                'status' => 422,
                'errors' => "Data no valid",
            ];
            return $this->response($data, 422);
        }
    }
}
