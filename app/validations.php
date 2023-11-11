<?php 

require_once "base.php";

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

// validasi inputan kode ref (required, numeric, ref === kode ref)
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

// validasi inputan username register (required, alfabet)
function validateUsername(&$errors, $username) {
    // cek apakah username sudah ada yang pakai di tabel admin, manajer, customer
    $statement = DB->prepare("SELECT username FROM admin WHERE username LIKE :username
                                UNION
                                SELECT username FROM manajer WHERE username LIKE :username
                                UNION
                                SELECT username FROM customer WHERE username LIKE :username");
    $statement->execute(array(":username" => $username));

    if (checkRequired($username)) {
        $errors["username"] = "username tidak boleh kosong";
    } else {
        if (!checkAlphaNumeric($username)) {
            $errors["username"] = "username harus gabungan huruf dan angka";
        // jika query ada isinya maka username sudah dipakai
        } else if ($statement->rowCount() > 0) {
            $errors["username"] = "username sudah digunakan";
        } else {
            $errors["username"] = "";
        }
    }
}

// validasi inputan username login (required, alphanumeric, mencari username di database)
function validateUsernameLogin(&$errors, $username) {
    //  cek apakah username ditemukan di database, jika ada akan mengembalikan role sesuai dengan tabel ditemukan username
    $statement = DB->prepare("SELECT 'admin' as role FROM admin WHERE username LIKE :username
                                UNION
                                SELECT 'manajer' as role FROM manajer WHERE username LIKE :username
                                UNION
                                SELECT 'customer' as role FROM customer WHERE username LIKE :username");
    $statement->execute(array(":username" => $username));
    
    if (checkRequired($username)) {
        $errors["username"] = "username tidak boleh kosong";
        return false;
    } else {
        if (!checkAlphaNumeric($username)) {
            $errors["username"] = "username harus gabungan huruf dan angka";
            return false;
        } else if ($statement->rowCount() == 0) {
            $errors["username"] = "username tidak ditemukan";
            return false;
        } else {
            $errors["username"] = "";
            // menampung hasil query ke array result
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $role = $result["role"];
            
            return $role;
        }
    }   
}

// validasi inputan password register (required, alfanumerik, panjang karakter)
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

// validasi login username dan password (required, kecocokan username dan password)
function validateLogin(&$errors, $username, $password) {
    // menambil role sesuai tabel ditemukannya username
    $role = validateUsernameLogin($errors, $username);

    if (checkRequired($password)) {
        $errors["password"] = "password tidak boleh kosong";
        return false;
    } else {
        if (!checkAlphaNumeric($password)) {
            $errors["password"] = "password harus gabungan angka dan huruf";
            return false;
        } else if (strlen($password) < 8) {
            $errors["password"] = "password tidak boleh kurang dari 8 karakter";
            return false;
        // cek jika role bukan false
        } else if ($role) {
            // cek apakah password inputan sesuai dengan password di database yang sudah dienkripsi
            $statement = DB->prepare("SELECT password FROM $role WHERE username = :username AND password = SHA2(:password, 0)");
            $statement->execute(array(":username" => $username, ":password" => $password));  
            // cek jika password tidak ditemukan 
            if ($statement->rowCount() == 0) {
                $errors["password"] = "password salah";
                return false;
            } else {
                $errors["password"] = "";
                return $role;
            }
        } 
    }
}


?>