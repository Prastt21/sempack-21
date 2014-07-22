<?php

if ($this->session->flashdata('FORM_NOTIFICATION') != '') {
    $notif = $this->session->flashdata('FORM_NOTIFICATION');
    $string = '<div class="alert ';
    if ($notif['status'] == 'success')
        $string .= 'alert-success alert-dismissable"><i class="fa fa-check"></i>';
    elseif ($notif['status'] == 'error')
        $string .= 'alert-danger alert-dismissable"><i class="fa fa-ban"></i>';
    elseif ($notif['status'] == 'info')
        $string .= 'alert-info alert-dismissable"><i class="fa fa-info"></i>';
    elseif ($notif['status'] == 'warning')
        $string .= 'alert-warning alert-dismissable"><i class="fa fa-warning"></i>';
    $string .= '<button class="close" aria-hidden="true" data-dismiss="alert" type="button"></button>
                <b></b>' . $notif['message'] . '</div>';
    echo $string;
}
if (isset($FORM_NOTIFICATION)) {
    $notif = $this->session->flashdata('FORM_NOTIFICATION');
    $string = '<div class="alert ';
    if ($notif['status'] == 'success')
        $string .= 'alert-success alert-dismissable"><i class="fa fa-check"></i>';
    elseif ($notif['status'] == 'error')
        $string .= 'alert-danger alert-dismissable"><i class="fa fa-ban"></i>';
    elseif ($notif['status'] == 'info')
        $string .= 'alert-info alert-dismissable"><i class="fa fa-info"></i>';
    elseif ($notif['status'] == 'warning')
        $string .= 'alert-warning alert-dismissable"><i class="fa fa-warning"></i>';
    $string .= '<button class="close" aria-hidden="true" data-dismiss="alert" type="button"></button>
                <b></b>' . $notif['message'] . '</div>';
    echo $string;
}
?>