<?php

class KiwysApiClient
{
    //const NEW_PASSWORD_CHALLENGE = 'NEW_PASSWORD_REQUIRED';
    //const FORCE_PASSWORD_STATUS = 'FORCE_CHANGE_PASSWORD';
    //const RESET_REQUIRED = 'PasswordResetRequiredException';
    const USER_NOT_FOUND = 'UserNotFoundException';
    const USER_ALREADY_EXISTS = 'UserAlreadyExistsException';
    const EMAIL_NOT_VERIFIED = 'EmailNotVerified';
    //const INVALID_PASSWORD = 'InvalidPasswordException'; 
    const TOKEN_MISMATCH = 'TokenMismatchException';
    const UNDEFINED_ERROR = 'UndefinedErrorException';
    //const EXPIRED_CODE = 'ExpiredCodeException';

    public $token;

    /**
     * KiwysApiClient constructor.
     * @param string $baseUri
     */
    public function __construct($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * Checks if credentials of a user are valid
     *
     * @param string $email
     * @param string $password
     * @param boolean $remember
     * @return \Aws\Result|bool
     */
    public function authenticate($email, $password)
    {

        $response = wp_remote_post($this->cleanEndpoint($this->baseUri) . '/auth/login', [
            'headers' => $this->headers(),
            'body' => json_encode([
                'email' => $email,
                'password' => $password
            ]),
        ]);
        /*var_dump($response);
        return;*/
        if (is_wp_error($response)) {
            $m = json_decode($response->get_error_message(), true);
            if (array_key_exists("code", $m)) {
                return $m["code"];
            }
            return false;
        } else {
            return json_decode(wp_remote_retrieve_body($response), true);
        }
    }

    /**
     * Get auth user details.
     *
     * @return mixed
     */
    public function getUser($token)
    {
        $response = wp_remote_get($this->cleanEndpoint($this->baseUri) . '/publisher', [
            'headers' => $this->headers([
                "Authorization" => "Bearer " . $token
            ])
        ]);
        if (is_wp_error($response)) {
            return $response;
        } else {
            return json_decode(wp_remote_retrieve_body($response), true);
        }
    }

    /**
     * Get categories.
     *
     * @return mixed
     */
    public function getCategories($token)
    {
        $response = wp_remote_get($this->cleanEndpoint($this->baseUri) . '/categories', [
            'headers' => $this->headers([
                "Authorization" => "Bearer " . $token
            ])
        ]);
        if (is_wp_error($response)) {
            return $response;
        } else {
            return json_decode(wp_remote_retrieve_body($response), true);
        }
    }

    /**
     * Get auth user website by url.
     *
     * @return mixed
     */
    public function getWebsite($token, $url)
    {
        $response = wp_remote_get($this->cleanEndpoint($this->baseUri) . '/websites/url/' . $url, [
            'headers' => $this->headers([
                "Authorization" => "Bearer " . $token
            ])
        ]);
        if (is_wp_error($response)) {
            return $response;
        } else {
            return json_decode(wp_remote_retrieve_body($response), true);
        }
    }

    /**
     * Get daily metrics
     *
     * @return mixed
     */
    public function getMetrics($token, $widget)
    {
        $response = wp_remote_get($this->cleanEndpoint($this->baseUri) . '/metrics/lite', [
            'headers' => $this->headers([
                "Authorization" => "Bearer " . $token
            ]),
            'body' => [
                'widget' => $widget,
            ],
        ]);
        if (is_wp_error($response)) {
            return $response;
        } else {
            return json_decode(wp_remote_retrieve_body($response), true);
        }
    }

    public function getAdsTxt($token)
    {
        $response = wp_remote_get($this->cleanEndpoint($this->baseUri) . '/adstxt', [
            'headers' => $this->headers([
                "Authorization" => "Bearer " . $token
            ])
        ]);
        if (is_wp_error($response)) {
            return $response;
        } else {
            return json_decode(wp_remote_retrieve_body($response), true);
        }
    }

    # HELPER FUNCTIONS

    private function headers($headers = [])
    {
        return array_merge([
            'Content-Type' => 'application/json; charset=UTF8',
            'X-Requested-With' => 'XMLHttpRequest',
        ], $headers);
    }

    /**
     * Remove leading or trailing forward slashes from the endpoint.
     * @param $endpoint
     * @return string
     */
    private function cleanEndpoint($endpoint)
    {
        $endpoint = ltrim($endpoint, "/");
        $endpoint = rtrim($endpoint, "/");
        return $endpoint;
    }
}
