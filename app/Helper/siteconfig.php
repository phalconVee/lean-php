<?php

if (!function_exists('json_output')) {

    /**
     * @param $data
     * @param $status
     * @throws Exception
     */
    function json_output($data, $status) {
        try {
            // remove any string that could create an invalid JSON
            // such as PHP Notice, Warning, logs...
            ob_clean();

            // this will clean up any previously added headers, to start clean
            header_remove();

            // Set the content type to JSON and charset
            // (charset can be set to something else)
            header("Content-type: application/json; charset=utf-8");

            http_response_code($status);

            // encode your PHP Object or Array into a JSON string.
            // stdClass or array
            echo json_encode($data);

            // making sure nothing is added
            exit();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}

