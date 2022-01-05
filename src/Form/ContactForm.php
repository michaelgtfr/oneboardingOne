<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 03/01/2022
 * Time: 14:23
 */

namespace App\Form;


use App\Entity\BusinessDepartment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstName',TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('businessDepartment', EntityType::class, [
                'label' => 'Département à contacter',
                'class' => BusinessDepartment::class,
                'choice_value' => 'id',
                'choice_label' => 'nameDepartment',
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message'
            ])
        ;
    }
}