<?php 

// database connection 
define("DB", new PDO('mysql:host=localhost;dbname=store', 'root', ''));

// validasi 

function checkRequired($field) {
    return empty(trim($field));
}

function checkAlphabet($field) {
    $pattern = "/^[a-zA-Z\s]+$/";
    return preg_match($pattern, $field);
}

function checkNumeric($field) {
    $pattern = "/^[0-9]+$/";
    return preg_match($pattern, $field);
}

function checkAlphaNumeric($field) {
    $pattern = "/^([a-zA-Z]+[0-9]+)|([0-9]+[a-zA-Z]+)$/";
    return preg_match($pattern, $field);
}

// validasi inputan kode ref (required, numeric, kecocokan)
function validateRef(&$errors, $ref, $role, $kode_ref) {
    if ($role == "admin" || $role == "manajer") {
        if (checkRequired($ref)) {
            $errors["ref"] = "kode refferal tidak boleh kosong";
        } else {
            if (!checkNumeric($ref)) {
                $errors["ref"] = "kode refferal harus berupa angka";
            } else if($ref !== $kode_ref[$role]) {
                $errors["ref"] = "kode refferal tidak sesuai";
            } else {
                $errors["ref"] = "";
            }
        }
    } else {
        if (!empty($ref)) {
            $errors["ref"] = "customer tidak perlu mengisi kode refferal";
        } else {
            $errors["ref"] = ""; 
        }
    }
    
}

// validasi inputan username (required, alfabet)
function validateUsername(&$errors, $username, $roles) {
    $statement = DB->prepare("SELECT username FROM $roles WHERE username = :username");
    $statement->execute(array(":username" => $username));
    var_dump($statement);
    if (checkRequired($username)) {
        $errors["username"] = "username tidak boleh kosong";
    } else {
        if (!checkAlphaNumeric($username)) {
            $errors["username"] = "username harus gabungan huruf dan angka";
        } else if ($statement->rowCount() > 0) {
            $errors["username"] = "username sudah digunakan";
        } else {
            $errors["username"] = "";
        }
    }
}

// validasi inputan password (required, alfanumerik, panjang karakter)
function validatePassword(&$errors, $password) {
    if (checkRequired($password)) {
        $errors["password"] = "password tidak boleh kosong";
    } else {
        if (!checkAlphaNumeric($password)) {
            $errors["password"] = "password harus gabungan angka dan huruf";
        } else if (strlen($password) < 8) {
            $errors["password"] = "password tidak boleh kurang dari 8 karakter";
        } else {
            $errors["password"] = "";
        }
    }
}

// validasi inputan konfirmasi password (required, password1==password2)
function validateConfirmPassword(&$errors, $password, $password2) {
    if (checkRequired($password2)) {
        $errors["password2"] = "harap konfirmasi password anda";
    } else {
        if ($password2 != $password) {
            $errors["password2"] = "password tidak sesuai";
        } else {
            $errors["password2"] = "";
        }
    }
}

// validasi inputan nama (required, alfabet)
function validateNama(&$errors, $nama) {
    if (checkRequired($nama)) {
        $errors["nama"] = "nama tidak boleh kosong";
    } else {
        if (!checkAlphabet($nama)) {
            $errors["nama"] = "nama harus berupa alfabet";
        } else {
            $errors["nama"] = "";
        }
    }
}

// validasi inputan telepon (required, numeric, panjang digit)
function validateTel(&$errors, $tel) {
    if (checkRequired($tel)) {
        $errors["tel"] = "nomor telepon tidak boleh kosong";
    } else {
        if (!checkNumeric($tel)) {
            $errors["tel"] = "nomor telepon harus berupa angka";
        } else if (strlen($tel) < 12) {
            $errors["tel"] = "tidak boleh kurang dari 12 digit";
        } else {
            $errors["tel"] = "";
        }
    }
}

// validasi inputan alamat (required)
function validateAlamat(&$errors, $address) {
    if (checkRequired($address)) {
        $errors["address"] = "alamat tidak boleh kosong";
    } else {
        $errors["address"] = "";
    }
}

function validateUsernameLogin(&$errors, $username) {
    $statement = DB->prepare("SELECT username FROM admin, manajer, customer WHERE username LIKE :username");
    $statement->execute(array(":username" => $username));

    if (checkRequired($username)) {
        $errors["username"] = "username tidak boleh kosong";
    } else {
        if (!checkAlphaNumeric($username)) {
            $errors["username"] = "username harus gabungan huruf dan angka";
        } else if ($statement->rowCount() == 0) {
            $errors["username"] = "username sudah digunakan";
        } else {
            $errors["username"] = "";
        }
    }
}


?>