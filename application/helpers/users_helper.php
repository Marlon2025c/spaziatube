<?php
/* ----------------------------------------
Function Pour s'avoir si les personnes sont bien connecter
----------------------------------------*/
function IsConnected()
{
    $CI = get_instance();
    if ($CI->session->userdata('id')) {
        return true;
    } else {
        return false;
    }
}
/* ----------------------------------------
Function pour s'avoir si la personne et admin du site
----------------------------------------*/
function IsAdmin()
{
    $CI = get_instance();
    $allowedRoles = ['Administrateur', 'Modérateur'];
    if (in_array($CI->session->userdata('role_name'), $allowedRoles)) {
        return true;
    } else {
        return false;
    }
    /* ----------------------------------------
        Classement des Grade
        '20' => 'User',
        '40' => 'VIP',
        '70' => 'Modo',
        '100' => 'Admin'
    ----------------------------------------*/
}

/* --------------------------------------- */
/* Pour avoir le mode dark/light avec btn */
/* -------------------------------------- */
function get_mode_stylesheet()
{
    $CI = get_instance();
    $mode = $CI->session->userdata('mode');
    return $mode == 'light' ? 'light' : 'dark';
}
