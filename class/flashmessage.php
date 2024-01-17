<?php
session_start();
const FLASH  = "FLASH MESSAGE";
const FLASH_ERROR = 'danger';
const FLASH_WARNING = 'warning';
const FLASH_INFO = 'info';
const FLASH_SUCCESS = 'success';

class FlashMessage {

    private function create_flash_message(string $name, string $message, string $type): void {
        // remove existing message with the name
        if (isset($_SESSION[FLASH][$name])) {
            unset($_SESSION[FLASH][$name]);
        }
        // add the message to the session
        $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];

        $flash_message = $_SESSION[FLASH][$name];
        // delete the flash message
        unset($_SESSION[FLASH][$name]);

        // display the flash message
        echo $this->format_flash_message($flash_message);
    }

    private function format_flash_message(array $flash_message)
    {

        echo sprintf("<div class='alert alert-%s alert-dismissible fade show' role='alert'>
            <strong>Please!</strong> %s.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>",
            $flash_message['type'],
            $flash_message['message']
        );
    }

    private function display_flash_message(string $name): void
    {
        if (!isset($_SESSION[FLASH][$name])) {
            return;
        }

        // get message from the session
        $flash_message = $_SESSION[FLASH][$name];

        // delete the flash message
        unset($_SESSION[FLASH][$name]);

        // display the flash message
        echo $this->format_flash_message($flash_message);
    }

    private function display_all_flash_messages(): void
    {
        if (!isset($_SESSION[FLASH])) {
            return;
        }

        // get flash messages
        $flash_messages = $_SESSION[FLASH];

        // remove all the flash messages
        unset($_SESSION[FLASH]);

        // show all flash messages
        foreach ($flash_messages as $flash_message) {
            echo $this->format_flash_message($flash_message);
        }
    }
    
    public function flash(string $name = '', string $message = '', string $type = ''): void
    {
        if ($name !== '' && $message !== '' && $type !== '') {
            $this->create_flash_message($name, $message, $type);
        } elseif ($name !== '' && $message === '' && $type === '') {
            $this->display_flash_message($name);
        } elseif ($name === '' && $message === '' && $type === '') {
            $this->display_all_flash_messages();
        }
    }

    public function unset_flash_message_session(string $name): void {
        if (isset($_SESSION[FLASH][$name])) {
            unset($_SESSION[FLASH][$name]);
        }
    }
    
}

