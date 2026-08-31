<?php
/**
 * Register ACF Gutenberg blocks and their fields.
 */

function sol_green_register_blocks() {
    if ( function_exists( 'register_block_type' ) ) {
        register_block_type( get_template_directory() . '/blocks/home/banner' );
        register_block_type( get_template_directory() . '/blocks/home/easy-steps' );
        register_block_type( get_template_directory() . '/blocks/home/numbering' );
        register_block_type( get_template_directory() . '/blocks/home/service_providers' );
    }
}
add_action( 'init', 'sol_green_register_blocks' );

function sol_green_register_block_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group(
        array(
            'key'      => 'group_banner_block',
            'title'    => 'Banner Block Fields',
            'fields'   => array(
                array(
                    'key'           => 'field_banner_image',
                    'label'         => 'Banner Image',
                    'name'          => 'banner_image',
                    'type'          => 'image',
                    'return_format' => 'array',
                    'preview_size'  => 'medium',
                ),
                array(
                    'key'   => 'field_banner_title',
                    'label' => 'Banner Title',
                    'name'  => 'banner_title',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_banner_saving',
                    'label' => 'Savings Label',
                    'name'  => 'banner_saving',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_banner_saving_percentage',
                    'label' => 'Savings Percentage',
                    'name'  => 'banner_saving_percentage',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_banner_button',
                    'label' => 'Banner Button',
                    'name'  => 'banner_button',
                    'type'  => 'link',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/banner',
                    ),
                ),
            ),
        )
    );
}
add_action( 'acf/init', 'sol_green_register_block_fields' );

function sol_green_register_easy_steps_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group(
        array(
            'key'      => 'group_easy_steps_block',
            'title'    => 'Easy Steps Block Fields',
            'fields'   => array(
                array(
                    'key'   => 'field_easy_steps_title',
                    'label' => 'Small Title',
                    'name'  => 'easy_steps_title',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_easy_steps_big_title',
                    'label' => 'Main Title',
                    'name'  => 'easy_steps_big_title',
                    'type'  => 'text',
                ),
                array(
                    'key'          => 'field_easy_steps_list',
                    'label'       => 'Steps',
                    'name'        => 'easy_steps_list',
                    'type'        => 'repeater',
                    'layout'      => 'block',
                    'button_label' => 'Add Step',
                    'sub_fields'  => array(
                        array(
                            'key'           => 'field_steps_svg_image',
                            'label'         => 'Step Image',
                            'name'          => 'steps_svg_image',
                            'type'          => 'image',
                            'return_format' => 'array',
                            'preview_size'  => 'medium',
                        ),
                        array(
                            'key'   => 'field_steps_count',
                            'label' => 'Step Number',
                            'name'  => 'steps_count',
                            'type'  => 'text',
                        ),
                        array(
                            'key'   => 'field_steps_title',
                            'label' => 'Step Title',
                            'name'  => 'steps_title',
                            'type'  => 'text',
                        ),
                        array(
                            'key'   => 'field_steps_description',
                            'label' => 'Step Description',
                            'name'  => 'steps_description',
                            'type'  => 'textarea',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/easy-steps',
                    ),
                ),
            ),
        )
    );
}
add_action( 'acf/init', 'sol_green_register_easy_steps_fields' );


function sol_green_register_numbering_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group(
        array(
            'key'      => 'group_numbering_block',
            'title'    => 'Numbering Block Fields',
            'fields'   => array(
                array(
                    'key'   => 'field_numbering_title',
                    'label' => 'Small Title',
                    'name'  => 'about_main_title',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_numbering_big_title',
                    'label' => 'Main Title',
                    'name'  => 'about_big_title',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_numbering_description',
                    'label' => 'Description',
                    'name'  => 'about_description',
                    'type'  => 'wysiwyg',
                ),
                array(
                    'key'   => 'field_numbering_solutions_title',
                    'label' => 'Solutions Title',
                    'name'  => 'solar_energy_solutions_title',
                    'type'  => 'text',
                ),
                array(
                    'key'          => 'field_numbering_list',
                    'label'       => 'Solutions List',
                    'name'        => 'solutions_list',
                    'type'        => 'repeater',
                    'layout'      => 'block',
                    'button_label' => 'Add Solution',
                    'sub_fields'  => array(
                        array(
                            'key'   => 'field_main_solution_title',
                            'label' => 'Main Solution Title',
                            'name'  => 'solution_title',
                            'type'  => 'text',
                        ),
                
                    ),
                ),
                array(
                    'key'   => 'field_numbering_year_of_experience',
                    'label' => 'About Year of Experience',
                    'name'  => 'about_year_of_experience',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_numbering_year_of_experience_description',
                    'label' => 'About Year of Experience Description',
                    'name'  => 'about_year_of_experience_description',
                    'type'  => 'wysiwyg',
                ),
                array(
                    'key'   => 'field_numbering_year_of_experience_image',
                    'label' => 'About Year of Experience Image',
                    'name'  => 'about_right_side_image',
                    'type'  => 'image',
                ),

                         array(
                    'key'          => 'field_numbering_list_below',
                    'label'       => 'Numbering List',
                    'name'        => 'numbering_list',
                    'type'        => 'repeater',
                    'layout'      => 'block',
                    'button_label' => 'Add Numbers',
                    'sub_fields'  => array(
                        array(
                            'key'   => 'field_main_numbering',
                            'label' => 'Main Number',
                            'name'  => 'main_numbering',
                            'type'  => 'text',
                        ),
                        array(
                            'key'   => 'field_main_numbering_details',
                            'label' => 'Main Number Details',
                            'name'  => 'numbering_details',
                            'type'  => 'wysiwyg',
                        ),
                    ),
                ),
                
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/numbering',
                    ),
                ),
            ),
        )
    );
}
add_action( 'acf/init', 'sol_green_register_numbering_fields' );


function sol_green_register_service_providers_fields() {
    
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group(
        array(
            'key'      => 'group_service_providers_block',
            'title'    => 'Service Providers Block Fields',
            'fields'   => array(
                array(
                    'key'   => 'field_service_providers_title',
                    'label' => 'Small Title',
                    'name'  => 'service_provide_mian_title',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_service_providers_big_title',
                    'label' => 'Main Title',
                    'name'  => 'service_provide_big_title',
                    'type'  => 'text',
                ),
               
                array(
                    'key'          => 'field_service_list',
                    'label'       => 'Service List',
                    'name'        => 'service_list',
                    'type'        => 'repeater',
                    'layout'      => 'block',
                    'button_label' => 'Add Service',
                    'sub_fields'  => array(
                        array(
                            'key'   => 'field_main_service_image',
                            'label' => 'Main Service Image',
                            'name'  => 'service_image',
                            'type'  => 'image',
                        ),
                        array(
                            'key'   => 'field_main_service_title',
                            'label' => 'Main Service Title',
                            'name'  => 'service_title',
                            'type'  => 'text',
                        ),
                        array(
                            'key'   => 'field_main_service_description',
                            'label' => 'Main Service Description',
                            'name'  => 'service_descrioption',
                            'type'  => 'wysiwyg',
                        ),
                        array(
                            'key'   => 'field_main_service_link',
                            'label' => 'Main Service Link',
                            'name'  => 'service_link',
                            'type'  => 'link',
                        ),
                    ),
                ),
               
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/service-providers',
                    ),
                ),
            ),
        )
    );
}
add_action( 'acf/init', 'sol_green_register_service_providers_fields' );
