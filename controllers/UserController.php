<?php

namespace Controllers;

use Models\User;
use Models\Category;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class UserController extends BaseController
{
    public function login()
    {
        $categories = Category::where('show_menu', 1)->get();
        return $this->render('account.login', compact('categories'));
    }
    public function post_login()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $usernameValidator = v::alnum()->noWhitespace()->length(1, 15);
        $passwordValidator = v::alnum()->noWhitespace()->length(6, 15);
        
        try {
            $usernameValidator->assert($username);
        } catch (NestedValidationException $exception) {
            $errors['username'] = $exception->getMessages();
        }
        try {
            $passwordValidator->assert($password);
        } catch (NestedValidationException $exception) {
            $errors['password'] = $exception->getMessages();
        }

        if ($errors) {
            $categories = Category::where('show_menu', 1)->get();
            return $this->render('account.login', compact('categories', 'username', 'password', 'errors'));
        } else {
            $user = User::where('name', $username)->where('password', $password)->first();
            if ($user) {
                $_SESSION['user'] = array(
                    'name' => $user->name,
                    'role' => $user->role
                );
                header('location: ' . BASE_URL);
            } else {
                header('location: ' . BASE_URL . 'login?error=Failed');
            };
        }
    }
    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION[CART]);
        header('location: ' . BASE_URL);
    }
}
