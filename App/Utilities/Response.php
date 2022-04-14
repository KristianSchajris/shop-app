<?php

class Response {
    private $status_code;
    private $success;
    private $message;
    private $data;

    public function __construct($status_code, $success, $message, $data) {
        $this->status_code = $status_code;
        $this->success     = $success;
        $this->message     = $message;
        $this->data        = $data;
    }

    public function getStatusCode() {
        return $this->status_code;
    }

    public function getSuccess() {
        return $this->success;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getData() {
        return $this->data;
    }

    public function toJson() {
        return json_encode(
            array(
                'status_code' => $this->status_code,
                'success'     => $this->success,
                'message'     => $this->message,
                'data'        => $this->data,
            ),
            JSON_UNESCAPED_UNICODE,
        );
    }
}