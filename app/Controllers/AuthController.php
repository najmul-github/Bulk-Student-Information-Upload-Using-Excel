<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Load the login view
        return view('auth/login');
    }

    public function login()
    {
        // Check if the form is submitted
        if ($this->request->getMethod() === 'post') {
            // Get the input values (e.g., username and password)
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            // Validate input fields (e.g., required fields, format checks)

            // Simulate authentication (replace with actual authentication logic)
            $authenticated = $this->authenticate($username, $password);

            if ($authenticated) {    
                $session = session();
                $userData = [
                    'username' => $username, // Set the user data as needed
                    'logged_in' => true
                ];
                $session->set($userData);
            //     // Set user session or authentication flag
            //     // Redirect to the admin dashboard
                return redirect()->to('/admin');
            } else {
            //     // Authentication failed, show error or redirect to login with error message
                return redirect()->to('/admin/login')->with('error', 'Invalid username or password');
            }
        }

        // If the method is not POST, load the login view
        return view('/admin/login');
    }

    public function logout()
    {
        // Destroy user session or authentication flag
        // Redirect to the login page
        return redirect()->to('/admin/login');
    }

    // Simulated authentication (replace with your actual authentication logic)
    private function authenticate($username, $password)
    {
        // Simulate a valid username and password
        $validUsername = 'admin';
        $validPassword = '1111';

        // Check if the provided credentials match the valid ones
        if ($username === $validUsername && $password === $validPassword) {
            return true; // Authentication successful
        }

        return false; // Authentication failed
    }
}
