<?php

declare(strict_types=1);

namespace App\FormType;

use App\Entity\Company;
use App\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class InvoiceFormType
 *
 * @package App\FormType
 */
class InvoiceFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextType::class, [
                'required' => true,
            ])
            ->add('cost', NumberType::class, [
                'required' => true,
            ])
            ->add('quantity', NumberType::class, [
                'required' => true,
            ])
            ->add('status', NumberType::class, [
                'required' => false,
            ])
            ->add('company', EntityType::class, [
                'class' => Company::class,
                'required' => true,
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Invoice::class,
            'csrf_protection' => true,
        ));
    }

    public function getBlockPrefix()
    {
        return '';
    }
}