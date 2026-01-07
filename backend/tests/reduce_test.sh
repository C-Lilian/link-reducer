#!/bin/sh

response=$(curl -s -o response.json -w "%{http_code}" \
  -X POST http://localhost:8000/reduce \
  -H "Content-Type: application/json" \
  -d '{"url":"https://lilian-cleret.com"}')

if [ "$response" != "200" ]; then
  echo "Expected 200, got $response"
  exit 1
fi

echo "Backend reduce endpoint works"
