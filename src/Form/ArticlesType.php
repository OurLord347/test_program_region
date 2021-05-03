<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Заголовок статьи',
                'attr' => [
                    'placeholder' => 'Введите текст'
                ]
            ))

            ->add('category', ChoiceType::class, array(
                'label' => 'Категория',
                'mapped' => false,
                'choices' => array(
                    'Моя статья'=> 'my',
                    'Не моя статья'=> 'not_my'
                )
            ))
            ->add('text',  TextareaType::class, array(
                'label' => 'Статья',
                'attr' => [
                    'placeholder' => 'Введите описание'
                ]
            ))
            ->add('picture', FileType::class, array(
                'label' => 'Превью',
                'required' => false,
                'mapped' => false
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Сохранить',
                'attr' => [
                    'class' => 'btn btn-success float-left mr-3'
                ]
            ))
            ->add('delete',SubmitType::class, array(
                'label' => 'Удалить',
                'attr' => [
                    'class' => 'btn btn-danger'
                ]
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
            'action' => '/save_articles'
        ]);
    }
}
