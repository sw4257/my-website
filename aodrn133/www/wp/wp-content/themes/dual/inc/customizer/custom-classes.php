<?php
/**
* Customizer Custom Classes.
*
* @package Dual
*/


/** Customizer Custom Control **/
if ( class_exists( 'WP_Customize_Control' ) ) {
    
    // Radio Image Custom Control Class.
    class Dual_Custom_Radio_Image_Control extends WP_Customize_Control {

        public $type = 'dual-radio-image';
    
        public function render_content() {
           
            if ( empty( $this->choices ) ) {
                return;
            }           
            
            $name = '_customize-radio-' . $this->id; ?>
            
            <span class="customize-control-title">
                <?php echo esc_attr( $this->label ); ?>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
            </span>
            
            <div id="input_<?php echo esc_attr($this->id); ?>" class="image dual-radio-image-buttenset">
                <?php foreach ( $this->choices as $value => $label ) : ?>
                    <input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo esc_attr($this->id) . esc_attr($value); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
                        <label for="<?php echo esc_attr($this->id) . esc_attr($value); ?>">
                            <img src="<?php echo esc_html( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
                        </label>
                    </input>
                <?php endforeach; ?>
            </div>
            
        <?php }
    }
    
}

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Dual_Customize_Section_Upsell extends WP_Customize_Section {

    /**
     * The type of customize section being rendered.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $type = 'dual_upsell';

    /**
     * Custom button text to output.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $pro_text = '';

    /**
     * Custom pro button URL.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $pro_url = '';

    public $notice = '';
    public $nonotice = '';

    /**
     * Add custom parameters to pass to the JS via JSON.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function json() {
        $json = parent::json();

        $json['pro_text'] = $this->pro_text;
        $json['pro_url']  = esc_url( $this->pro_url );
        $json['notice']  = esc_attr( $this->notice );
        $json['nonotice']  = esc_attr( $this->nonotice );

        return $json;
    }

    /**
     * Outputs the Underscore.js template.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    protected function render_template() { ?>

        <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

                <# if ( data.notice ) { #>
                    <h3 class="accordion-section-notice">
                        {{ data.title }}
                    </h3>
                <# } #>

                <# if ( !data.notice ) { #>
                    <h3 class="accordion-section-title">
                        {{ data.title }}

                        <# if ( data.pro_text && data.pro_url ) { #>
                            <a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
                        <# } #>
                    </h3>
                <# } #>
            
        </li>
    <?php }
}

if ( class_exists( 'WP_Customize_Control' ) ) {
    
    // Repeator Info
    class Dual_Premium_Notiece_Control extends WP_Customize_Control {

        public $type = 'dual-premiuminfonotice';
    
        public function render_content() {
           
            $name = '_customize-notice-' . $this->id; ?>
            
            <span class="customize-control-title">
                <div class="theme-info-icon">
                    <div class="icon-notice-wrap">
                        <span class="dashicons dashicons-lightbulb twp-filter-icon"></span>
                        <span><?php echo esc_html__('More ','dual'). esc_html( $this->label ). esc_html__(' Available on Premium Version.', 'dual' ); ?></span>
                    </div>
                </div>
            </span>
            
        <?php }
    }
    
}