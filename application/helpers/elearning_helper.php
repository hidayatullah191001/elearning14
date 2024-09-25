<?php  

function isOperator($role_id){
	$ci = get_instance();
	if(!$ci->session->userdata('email', 'role_id'))
	{
		$ci->session->unset_userdata('email', 'role_id');
		$ci->session->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Login terlebih dahulu!</div>');
		redirect('auth');
	}else if($role_id != 3){
		$ci->session->unset_userdata('email', 'role_id');
		$ci->session->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Sorry, you dont have access this page!</div>');
		redirect('auth');
	}
}

function isGuru($role_id){
	$ci = get_instance();
	if(!$ci->session->userdata('email', 'role_id'))
	{
		$ci->session->unset_userdata('email', 'role_id');
		$ci->session->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Login terlebih dahulu!</div>');
		redirect('auth');
	}else if($role_id != 2){
		$ci->session->unset_userdata('email', 'role_id');
		$ci->session->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Sorry, you dont have access this page!</div>');
		redirect('auth');
	}
}

function isSiswa($role_id){
    $ci = get_instance();
    if(!$ci->session->userdata('email', 'role_id'))
    {
        $ci->session->unset_userdata('email', 'role_id');
        $ci->session->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Login terlebih dahulu!</div>');
        redirect('auth');
    }else if($role_id != 1){
        $ci->session->unset_userdata('email', 'role_id');
        $ci->session->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Sorry, you dont have access this page!</div>');
        redirect('auth');
    }
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


function encryptId( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = openssl_encrypt($q, "AES-128-ECB", $cryptKey);
    return( $qEncoded );
}

function decryptId( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded   = openssl_decrypt($q, "AES-128-ECB", $cryptKey);
    return( $qDecoded );
}

function alert_success($message)
{
    $ci = get_instance();
    return $ci->session->set_flashdata('message', '<div class="alert alert-success">'.$message.'</div>');
}
function alert_danger($message)
{
    $ci = get_instance();
    return $ci->session->set_flashdata('message', '<div class="alert alert-danger">'.$message.'</div>');
}
