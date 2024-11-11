<?php
/**
 * Template for displaying template Our team element layout 3.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/our-team/layout-3.php.
 *
 * @author      ThimPress
 * @package     BuilderPress/Templates
 * @version     1.0.0
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;
$size = apply_filters( 'builder-press/our-team/layout-3/image-size', '281x281' );
?>

<div class="owl-carousel owl-theme our-team">
    <?php foreach ( $members as $member ) { ?>

        <?php $avatar_id = ! empty( $member['photo'] ) ? (int) $member['photo'] : ''; ?>

        <div class="item">
            <div class="item-inner">
                <!--                    photo-->
                <?php if ( $avatar_id ) { ?>
                    <div class="avatar-contact">
                        <div class="avatar">
                            <?php $image = wp_get_attachment_image_src( $avatar_id, 'full' ); ?>

                            <?php
                                builder_press_get_attachment_image($avatar_id,$size);
                            ?>
                        </div>
                        <!--                        contact-->
                        <?php if ( ! empty( $member['contacts'] ) ) { ?>
                            <div class="contact">
                                <?php if ( ! empty( $member['contacts'] ) ) {
                                    $contacts = $member['contacts'];
	                                if ( is_string( $contacts ) ) {
		                                $el_contacts = explode('|', $contacts);
		                                $contacts = array();
		                                $i = 0;
		                                while ( $i < $el_contacts[0] ) {
			                                $i++;
			                                $fields_contact = explode( ',', $el_contacts[1] );
			                                $contact_item = array();
			                                foreach ( $fields_contact as $value_c ) {
				                                $key = $value_c.$i;
				                                if ( isset( $member[$value_c.$i] ) ){
					                                $contact_item[$value_c] = $member[$value_c.$i];
				                                }
			                                }
			                                $contacts[] = $contact_item;
		                                }
	                                }
                                    foreach ( $contacts as $contact ) {
                                        switch ( $contact['icon'] ) {
                                            case 'font_ionicons':
                                                if ( ! empty( $contact['font_ionicons'] ) ) { ?>
                                                    <a href="<?php echo esc_url( $contact['url'] ); ?>">
                                                        <i class="<?php echo esc_attr( $contact['font_ionicons'] ); ?> icon-ionicons"
                                                           aria-hidden="true"></i>
                                                    </a>
                                                <?php }
                                                break;
                                            default:
                                                if ( ! empty( $contact['font_awesome'] ) && ! empty( $contact['url'] ) ) {
                                                    $icon = $contact['font_awesome'];
                                                    if ($contact['font_awesome'] == 'fa fa-twitter') {
                                                        $icon = "fa fa-x-twitter";
                                                    }
                                                     ?>
                                                    <a href="<?php echo esc_url( $contact['url'] ); ?>">
                                                        <i class="<?php echo esc_attr( $icon ); ?> icon-fontawesome"
                                                           aria-hidden="true"></i></a>
                                                    <?php
                                                }
                                                break;
                                        }
                                    }
                                } ?>

                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <div class="information">
                    <!--                        name-->
                    <?php if ( ! empty( $member['name'] ) ) { ?>
                        <h3 class="name">
                            <?php if ( ! empty( $member['link'] ) ) { ?>
                            <a href="<?php echo esc_url( $member['link'] ); ?>" class="url">
                                <?php } ?>
                                <?php echo esc_html( $member['name'] ); ?>
                                <?php if ( ! empty( $member['link'] ) ) { ?>
                            </a>
                        <?php } ?>
                        </h3>
                    <?php } ?>

                    <!--                        job-->
                    <?php if ( ! empty( $member['job'] ) ) { ?>
                        <span class="job"><?php echo esc_html( $member['job'] ); ?></span>
                    <?php } ?>


                    <?php if( ! empty($member['description'] ) ){?>
                        <div class="description">
                            <?php echo esc_html($member['description']) ?>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    <?php } ?>
</div>