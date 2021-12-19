<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 18/12/2021
 * Time: 12:21
 */

namespace App\Form;


use App\Entity\BusinessDepartment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactForm extends AbstractType
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $businessDepartmentList = $this->recoverBusinessDepartmentList();

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
            ->add('businessDepartment', ChoiceType::class, [
                'label' => 'Département à contacter',
                'choices' => [
                    $businessDepartmentList
                    ],
                'choice_value' => 'id',
                'choice_label' => 'nameDepartment',
                'group_by' => function() {
                    return null;
                }
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message'
            ]);
    }

    public function recoverBusinessDepartmentList()
    {
        return $this->em->getRepository(BusinessDepartment::class)->findAll();
    }
}