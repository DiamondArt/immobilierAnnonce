<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdFormType extends AbstractType
{
 /**
  * configuration de base des champs de notre formulaire
  *
  * @param string $label
  * @param string placeholder
  * @return array
  */
 private function configForm($label, $placeholder)
 {
    return [
        'label'=>$label,
        'attr' => ['placeholder'=> $placeholder ]];
 }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, $this->configForm("titre" ,"Ajouter un titre à l'annonce" ))
            ->add('introduction',TextareaType::class, $this->configForm("Résumé", "Ajouter un résumé à l'annonce"))
            ->add('coverImage',UrlType::class, $this->configForm("Image", "Ajouter ule lien d'une image de l'annonce"))
            ->add('content',TextareaType::class, $this->configForm("Description", "Ajouter une description à l'annonce"))
            ->add('slug', UrlType::class, $this->configForm("Adresse web", "Ajouter le site web de l'annonce"))
            ->add('rooms',IntegerType::class, $this->configForm("Nombre de pièce", "Ajouter le nombre de pièce "))
            ->add('price', MoneyType::class, $this->configForm("Montant", "Ajouter le montant de cette annonce "));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
