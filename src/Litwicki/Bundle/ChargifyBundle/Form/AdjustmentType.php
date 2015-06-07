<?php

namespace Litwicki\Bundle\ChargifyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdjustmentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subscription_id')
            ->add('type')
            ->add('transaction_type')
            ->add('product_id')
            ->add('created_at')
            ->add('payment_id')
            ->add('amount')
            ->add('amount_in_cents')
            ->add('memo')
            ->add('adjustment_method')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Litwicki\Bundle\ChargifyBundle\Entity\Adjustment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'litwicki_bundle_chargifybundle_adjustment';
    }
}
