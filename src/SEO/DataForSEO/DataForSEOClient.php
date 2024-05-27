<?php

	namespace EasyAI\SEO\DataForSEO;

	use Exception;

	/**
	 * PHP 7.4-8.0 REST Client build with cURL
	 *
	 * @author Fabio Agostinho Boris <fabioboris@gmail.com>
	 * @added DataForSEO
	 */
	class DataForSEOClient
	{
		private ?string $token;       // Auth token
		public ?int $port = null;
		public string $scheme;
		public string $post_type = 'json';
		public int $timeout = 60;
		public int $connection_timeout = 10;
		private ?string $ba_ua;
		public string $last_url = '';
		public $last_response = null;
		public $last_http_code = null;

		public function __construct(string $host = null, string $token = null, string $ba_user = null, string $ba_password = null, string $ba_user_agent = null)
		{
			if (isset($host)) {
				$host = $host;
			} else {
				// Use default
				$host = 'https://api.dataforseo.com/';
			}

			// DataForSEO User
			if (isset($ba_user)) {
				$ba_user = $ba_user;
			} elseif (getenv('DATAFORSEO_LOGIN')) {
				/* Use getenv */
				$ba_user = getenv('DATAFORSEO_LOGIN');
			} elseif (isset($_ENV['DATAFORSEO_LOGIN'])) {
				/* Use $_ENV */
				$ba_user = $_ENV['DATAFORSEO_LOGIN'];
			} else {
				throw new Exception('You have to provide a `DATAFORSEO_LOGIN` env var to request Pinecone.');
			}

			// DataForSEO Password
			if (isset($ba_password)) {
				$ba_password = $ba_password;
			} elseif (getenv('DATAFORSEO_PASSWORD')) {
				/* Use getenv */
				$ba_password = getenv('DATAFORSEO_PASSWORD');
			} elseif (isset($_ENV['DATAFORSEO_PASSWORD'])) {
				/* Use $_ENV */
				$ba_password = $_ENV['DATAFORSEO_PASSWORD'];
			} else {
				throw new Exception('You have to provide a `DATAFORSEO_PASSWORD` env var to request Pinecone.');
			}

			$arr_h = parse_url($host);
			if (isset($arr_h['port'])) {
				$this->port = (int)$arr_h['port'];
				$this->host = str_replace(':' . $this->port, '', $host);
			} else {
				$this->port = null;
				$this->host = $host;
			}
			if (isset($arr_h['scheme'])) {
				$this->scheme = $arr_h['scheme'];
			}
			$this->token = $token;
			$this->ba_user = $ba_user;
			$this->ba_password = $ba_password;
			$this->ba_ua = $ba_user_agent;
		}

		/**
		 * Returns the absolute URL
		 *
		 * @param string $raw_headers
		 */
		private function http_parse_headers(string $raw_headers): array
		{
			$headers = array();
			$key = '';

			foreach (explode("\n", $raw_headers) as $h) {
				$h = explode(':', $h, 2);
				if (isset($h[1])) {
					if (!isset($headers[$h[0]])) {
						$headers[$h[0]] = trim($h[1]);
					} elseif (is_array($headers[$h[0]])) {
						$headers[$h[0]] = array_merge($headers[$h[0]], array(trim($h[1])));
					} else {
						$headers[$h[0]] = array_merge(array($headers[$h[0]]), array(trim($h[1])));
					}
					$key = $h[0];
				} else {
					if (substr($h[0], 0, 1) == "\t") {
						$headers[$key] .= "\r\n\t" . trim($h[0]);
					} elseif (!$key) {
						$headers[0] = trim($h[0]);
					}
				}
			}

			return $headers;
		}

		/**
		 * Returns the absolute URL
		 *
		 * @param string|null $url
		 * @return string
		 */
		private function url(string $url = null): string
		{
			$_host = rtrim($this->host, '/');
			$_url = ltrim($url, '/');

			return "{$_host}:{$this->port}/{$_url}";
		}

		/**
		 * Returns the URL with encoded query string params
		 *
		 * @param string $url
		 * @param array|null $params
		 * @return string
		 */
		private function urlQueryString(string $url, array $params = null): string
		{
			$qs = array();
			if ($params) {
				foreach ($params as $key => $value) {
					$qs[] = "{$key}=" . urlencode($value);
				}
			}

			$url = explode('?', $url);
			if (isset($url[1])) {
				$url_qs = $url[1];
			}
			$url = $url[0];
			if (isset($url_qs)) {
				$url = "{$url}?{$url_qs}";
			}

			if (count($qs)) {
				return "{$url}?" . implode('&', $qs);
			} else {
				return $url;
			}
		}

		/**
		 * Make an HTTP request using cURL
		 *
		 * @param string $verb
		 * @param string $url
		 * @param array $params
		 */
		private function request(string $verb, string $url, array $params = array())
		{

			$ch = curl_init();       // the cURL handler
			$url = $this->url($url); // the absolute URL
			$request_headers = array();
			if (!empty($this->token)) {
				$request_headers[] = "Authorization: {$this->token}";
			}

			if ((!empty($this->ba_user)) and (!empty($this->ba_password))) {
				curl_setopt($ch, CURLOPT_USERPWD, $this->ba_user . ':' . $this->ba_password);
			}

			// encoded query string on GET
			switch (true) {
				case 'GET' == $verb:
					$url = $this->urlQueryString($url, $params);
					break;
				case in_array($verb, array(
					'POST',
					'PUT',
					'DELETE'
				), false):
					if ($this->post_type == 'json') {
						$request_headers[] = 'Content-Type: application/json';
						curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
					} else {
						curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
					}
			}

			// set the URL
			curl_setopt($ch, CURLOPT_URL, $url);
			$this->last_url = $url;

			// set the HTTP verb for the request
			switch ($verb) {
				case 'POST':
					curl_setopt($ch, CURLOPT_POST, true);
					break;
				case 'PUT':
				case 'DELETE':
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $verb);
			}

			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connection_timeout);
			curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
			if (!empty($this->ba_ua)) {
				curl_setopt($ch, CURLOPT_USERAGENT, $this->ba_ua);
			}
			if (!empty($this->port)) {
				curl_setopt($ch, CURLOPT_PORT, $this->port);
			}
			if ((!empty($this->scheme)) and ($this->scheme == 'https')) {
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			} else {
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			}

			$response = curl_exec($ch);

			$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
			$headers = $this->http_parse_headers(substr($response, 0, $header_size));
			$response = substr($response, $header_size);
			$http_code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
			$content_error = curl_error($ch);
			//var_dump($content_error);

			curl_close($ch);

			if (strpos($content_type, 'json')) {
				$response = json_decode($response, true);
			}

			$this->last_response = $response;
			$this->last_http_code = $http_code;

			switch (true) {
				case 'GET' == $verb:
					if ($http_code !== 200) {
						if (is_array($response)) {
							$this->throw_error($response, $http_code);
						} else {
							$this->throw_error(trim($content_error . "\n" . $response), $http_code);
						}
					}
					return $response;
				case in_array($verb, array(
					'POST',
					'PUT',
					'DELETE'
				), false):
					if (($http_code !== 303) and ($http_code !== 200)) {
						if (is_array($response)) {
							$this->throw_error($response, $http_code);
						} else {
							$this->throw_error(trim($content_error . "\n" . $response), $http_code);
						}
					}
					if ($http_code === 200) {
						return $response;
					} else {
						return str_replace(rtrim($this->host, '/') . '/', '', $headers['Location']);
					}
			}
		}

		private function throw_error($response, $http_code)
		{
			if (is_array($response) && array_key_exists('error', $response)) {
				if ((isset($response['error']['message'])) and (isset($response['error']['code']))) {
					if (is_array($response['error']['message'])) {
						throw new RestClientException(implode('; ', $response['error']['message']), (int)$response['error']['code'], $http_code);
					} else {
						throw new RestClientException($response['error']['message'], (int)$response['error']['code'], $http_code);
					}
				} else {
					throw new RestClientException(implode('; ', $response), 0, $http_code);
				}
			} else {
				if (is_string($response)) {
					throw new RestClientException($response, 0, $http_code);
				} else {
					throw new RestClientException(json_encode($response), 0, $http_code);
				}
			}
		}

		/**
		 * Make an HTTP GET request
		 *
		 * @param string $url
		 * @param array $params
		 */
		public function get($url, $params = array())
		{
			return $this->request('GET', $url, $params);
		}

		/**
		 * Make an HTTP POST request
		 *
		 * @param string $url
		 * @param array $params
		 */
		public function post($url, $params = array())
		{
			return $this->request('POST', $url, $params);
		}

		/**
		 * Make an HTTP PUT request
		 *
		 * @param string $url
		 * @param array $params
		 */
		public function put($url, $params = array())
		{
			return $this->request('PUT', $url, $params);
		}

		/**
		 * Make an HTTP DELETE request
		 *
		 * @param string $url
		 * @param array $params
		 */
		public function delete($url, $params = array())
		{
			return $this->request('DELETE', $url, $params);
		}
	}

	class RestClientException extends Exception
	{
		protected $http_code;

		public function __construct(string $message, int $code = 0, int $http_code = 0, Exception $previous = null)
		{
			$this->http_code = $http_code;
			parent::__construct($message, $code, $previous);
		}

		/**
		 * @return int the http code error representation of the exception.
		 */
		public function getHttpCode()
		{
			return $this->http_code;
		}

		/**
		 * @return string the string representation of the exception.
		 */
		public function __toString(): string
		{
			return __CLASS__ . ": [{$this->code}]: {$this->message} (HTTP status code: {$this->http_code})\n";
		}

	}
