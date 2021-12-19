<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 18/12/2021
 * Time: 12:21
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContatForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstName',TextType::class, [
                'label' => 'prénom'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('businessDepartement', ChoiceType::class, [
                'label' => 'Département à contacter'
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message'
            ]);
    }
}