<?php 
namespace GosofieAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
 
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class gosofie_testimonial extends Widget_Base {

    public function get_name() {
        return 'gosofie-testimonial';
    }

    public function get_title() {
        return __('Testimonial', 'gosoFie');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return array('gosofie-addons');
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('General', 'gosoFie'),
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'img',
            [
                'label' => __('Image', 'gosofie'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'title', [
                'type' => Controls_Manager::TEXT,
                'label' =>   esc_html__('Title ', 'gosofie'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'des', [
                'type' => Controls_Manager::TEXT,
                'label' =>   esc_html__('Designation ', 'gosofie'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'info', [
                'type' => Controls_Manager::TEXTAREA,
                'label' =>   esc_html__('Info ', 'gosofie'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'lists',
            [
                'label' => esc_html__( 'Testimonial List', 'gosofie' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,

                'default' => [
                    [
                        'title' => 'Robert Watson',
                    ],[
                        'title' => 'Robert Watson',
                    ],[
                        'title' => 'Robert Watson',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();



        $this->start_controls_section(
            'section_sdr',
            [
                'label' => __( 'Service Title', 'gosofie' ),
                'tab' => Controls_Manager::TAB_STYLE,               
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'prty',
                'label' =>   esc_html__('Typography', 'gosofie'),
                'selector' => '{{WRAPPER}} .testimonial-slider h5',
            ]
        );

        $this->add_control(
            'nclr',
            [
                'label' =>   esc_html__( 'Color', 'gosofie' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider h5' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section(); 
        $this->start_controls_section(
            'section_sdr2',
            [
                'label' => __( 'Service Info', 'gosofie' ),
                'tab' => Controls_Manager::TAB_STYLE,               
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'prty2',
                'label' =>   esc_html__('Typography', 'gosofie'),
                'selector' => '{{WRAPPER}} .testimonial-slider p',
            ]
        );

        $this->add_control(
            'nclr2',
            [
                'label' =>   esc_html__( 'Color', 'gosofie' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

    }
        
    protected function render() {

        require dirname(__FILE__) .'/one.php';
    }

}

$widgets_manager->register_widget_type(new \GosofieAddon\Widgets\gosofie_testimonial());