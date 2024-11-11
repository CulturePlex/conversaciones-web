<?php
/**
 * Template for displaying template Our team element layout marketing.
 *
 * This template can be overridden by copying it to yourtheme/builderpress/our-team/marketing-layout-1.php.
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
$size = apply_filters( 'builder-press/our-team/marketing-layout-1/image-size', '262x329' );
?>

<div class="wrap-element">
    <div class="row">
        <?php foreach ( $members as $member ) {
            $avatar_id = ! empty( $member['photo'] ) ? (int) $member['photo'] : '';
        ?>
            <div class="col-sm-6 col-lg-3">
                <div class="item-team">
                    <div class="image-team">
                        <?php
                            builder_press_get_attachment_image($avatar_id, $size);
                        ?>

                        <?php if ( ! empty( $member['link'] ) ) { ?>
                            <a href="<?php echo esc_url($member['link']) ?>" class="overlay-image"></a>
                        <?php } ?>

                        <div class="social-team">
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
                                                <a href="<?php echo esc_url( $contact['url'] ); ?>" class="item-social">
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
                                                <a href="<?php echo esc_url( $contact['url'] ); ?>" class="item-social">
                                                    <i class="<?php echo esc_attr( $icon ); ?> icon-fontawesome"
                                                       aria-hidden="true"></i></a>
                                                <?php
                                            }
                                            break;
                                    }
                                }
                            } ?>
                        </div>
                    </div>

                    <div class="text-team">
                        <h3 class="name-team">
                            <a href="<?php echo esc_url($member['link']) ?>">
                                <?php echo esc_html( $member['name'] ); ?>
                            </a>
                        </h3>

                        <?php if ( ! empty( $member['job'] ) ) { ?>
                            <div class="info-team">
                                <?php echo esc_html( $member['job'] ); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>