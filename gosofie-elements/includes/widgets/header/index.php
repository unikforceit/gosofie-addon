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


class gosofie_builder_header extends Widget_Base {

    public function get_name() {
        return 'gosofie-header';
    }

    public function get_title() {
        return __('Header', 'gosoFie');
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

        $this->add_control(
            'logo',
            [
                'label' => __('Logo', 'gosofie'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],                
            ]
        );
        $this->add_control(
            'menu',
            [
                'label' => __('Desktop nav', 'gosofie'),
                'type' => Controls_Manager::SELECT2,
                'options' =>  king_menu_select_choices(), 
                'multiple' => false,
                'label_block' => true,
                'condition' => [
                    'style!' => 'style_one',
                ],                  
            ]
        );

        $this->add_control(
            'b1lbl', [
                'type' => Controls_Manager::TEXT,
                'label' =>   esc_html__('Label ', 'thepack'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'b1url', [
                'type' => Controls_Manager::URL,
                'label' =>   esc_html__('Link', 'thepack'),
            ]
        );
        $this->end_controls_section();



        $this->start_controls_section(
            'section_sdr',
            [
                'label' => __( 'Menu Style', 'gosofie' ),
                'tab' => Controls_Manager::TAB_STYLE,               
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'prty',
                'label' =>   esc_html__('Typography', 'thepack'),
                'selector' => '{{WRAPPER}} .home-main-header .menu-navigation li a',
            ]
        );

        $this->add_control(
            'nclr',
            [
                'label' =>   esc_html__( 'Color', 'thepack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home-main-header .menu-navigation li a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

    }
        
    protected function render() {


        require dirname(__FILE__) .'/one.php';
    }

}

$widgets_manager->register_widget_type(new \GosofieAddon\Widgets\gosofie_builder_header());