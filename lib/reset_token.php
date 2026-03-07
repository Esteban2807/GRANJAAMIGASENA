<?php
function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
function base64url_decode($data) {
    return base64_decode(strtr($data, '-_', '+/'));
}
function createResetToken($documento, $secret) {
    $ts = time();
    $data = $documento . '|' . $ts;
    $sig = hash_hmac('sha256', $data, $secret, true);
    return base64url_encode($data) . '.' . base64url_encode($sig);
}
function parseResetToken($token, $secret, $ttlSeconds) {
    $parts = explode('.', $token);
    if (count($parts) !== 2) return [false, null];
    $data = base64url_decode($parts[0]);
    $sig = base64url_decode($parts[1]);
    if (!$data || !$sig) return [false, null];
    $calc = hash_hmac('sha256', $data, $secret, true);
    if (!hash_equals($calc, $sig)) return [false, null];
    $pieces = explode('|', $data);
    if (count($pieces) !== 2) return [false, null];
    $documento = $pieces[0];
    $ts = intval($pieces[1]);
    if ($ttlSeconds > 0 && (time() - $ts) > $ttlSeconds) return [false, null];
    return [true, $documento];
}
