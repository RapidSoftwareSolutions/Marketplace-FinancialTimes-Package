<?php

$app->post('/api/FinancialTimes/searchContent', function ($request, $response) {
    /** @var \Slim\Http\Response $response */
    /** @var \Slim\Http\Request $request */
    /** @var \Models\checkRequest $checkRequest */

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'queryString']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $postData = $validateRes;
    }

    $url = $settings['apiUrl'] . "/search/v1";

    $param['apiKey'] = $postData['args']['apiKey'];
    $json['queryString'] = $postData['args']['queryString'];

    if (!empty($postData['args']['curations'])) {
        if (is_array($postData['args']['curations'])) {
            $json['queryContext']['curations'] = $postData['args']['curations'];
        }
        else {
            $json['queryContext']['curations'] = explode(',', $postData['args']['curations']);
        }
    }
    if (!empty($postData['args']['maxResults'])) {
        $json['resultContext']['maxResults'] = $postData['args']['maxResults'];
    }
    if (!empty($postData['args']['offset'])) {
        $json['resultContext']['offset'] = $postData['args']['offset'];
    }
    if (isset($postData['args']['sortOrder']) && strlen($postData['args']['sortOrder']) > 0) {
        $json['resultContext']['sortOrder'] = $postData['args']['sortOrder'];
    }
    if (isset($postData['args']['sortField']) && strlen($postData['args']['sortField']) > 0) {
        $json['resultContext']['sortField'] = $postData['args']['sortField'];
    }
    if (!empty($postData['args']['aspects'])) {
        if (is_array($postData['args']['aspects'])) {
            $json['resultContext']['aspects'] = $postData['args']['aspects'];
        }
        else {
            $json['resultContext']['aspects'] = explode(',', $postData['args']['aspects']);
        }
    }
    if (!empty($postData['args']['facetNames'])) {
        if (is_array($postData['args']['facetNames'])) {
            $json['resultContext']['facets']['names'] = $postData['args']['facetNames'];
        }
        else {
            $json['resultContext']['facets']['names'] = explode(',', $postData['args']['facetNames']);
        }
    }
    if (!empty($postData['args']['facetsMaxElements'])) {
        $json['resultContext']['facets']['maxElements'] = $postData['args']['facetsMaxElements'];
    }
    if (!empty($postData['args']['facetsMinThreshold'])) {
        $json['resultContext']['facets']['minThreshold'] = $postData['args']['facetsMinThreshold'];
    }

    try {
        /** @var GuzzleHttp\Client $client */
        $client = $this->httpClient;
        $vendorResponse = $client->post($url, [
            'query' => $param,
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $json
        ]);
        $vendorResponseBody = $vendorResponse->getBody()->getContents();
        if ($vendorResponse->getStatusCode() == 200) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = json_decode($vendorResponse->getBody());
        }
        else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($vendorResponseBody) ? $vendorResponseBody : json_decode($vendorResponseBody);
        }
    } catch (\GuzzleHttp\Exception\BadResponseException $exception) {
        $vendorResponseBody = $exception->getResponse()->getBody();
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = json_decode($vendorResponseBody);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});
