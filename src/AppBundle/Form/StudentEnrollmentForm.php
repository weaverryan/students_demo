<?php

namespace AppBundle\Form;

use AppBundle\Entity\Student;
use AppBundle\Entity\StudentEnrollment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentEnrollmentForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('studentId', EntityType::class, [
                'property_path' => 'student',
                'class' => Student::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StudentEnrollment::class,
            'csrf_protection' => false,
        ]);
    }
}
