<?php

namespace Symfony\UX\Quill\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuillType extends AbstractType
{
    public function __construct(
        private ContainerInterface $container
    ){
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $controller = 'quill';
//        $preset = $options['preset'];

        dump($this->container);

        $view->vars['row_attr'] = [
            'data-controller' => $controller,
            "data-$controller-options-value" => json_encode($options['options']),
        ];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'options' => [
                'modules' => [
                    'toolbar' => [
                        [
                            [
                                'header' => [1, 2, false]
                            ]
                        ],
                        ['bold', 'italic', 'underline'],
                        ['image', 'code-block']
                    ]
                ],
                'placeholder' => 'Compose an epic...',
                'theme' => 'snow'
            ],
            'preset' => 'default',

        ]);
    }

    public function getParent()
    {
        return TextareaType::class;
    }

    public function getBlockPrefix()
    {
        return 'quill';
    }
}
