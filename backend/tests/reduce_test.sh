#!/bin/sh

# Nom du service backend (Docker Compose)
BACKEND_HOST=link_reducer_backend
BACKEND_PORT=80

# URL de test
TEST_URL="https://lilian-cleret.com"
ENDPOINT="http://$BACKEND_HOST:$BACKEND_PORT/reduce"

# Timeout max en secondes
TIMEOUT=30
SECONDS_PASSED=0

echo "Attente du backend ($BACKEND_HOST:$BACKEND_PORT)..."

# Boucle jusqu'à ce que le backend réponde ou timeout
while true; do
    HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" -X POST "$ENDPOINT" \
        -H "Content-Type: application/json" \
        -d "{\"url\":\"$TEST_URL\"}" || echo "000")

    if [ "$HTTP_CODE" = "200" ]; then
        echo "Backend prêt ! HTTP $HTTP_CODE"
        break
    fi

    SECONDS_PASSED=$((SECONDS_PASSED + 1))
    if [ "$SECONDS_PASSED" -ge $TIMEOUT ]; then
        echo "Timeout : le backend n'a pas répondu en $TIMEOUT secondes."
        exit 1
    fi

    sleep 1
done

# Requête finale pour vérifier le format de la réponse
RESPONSE=$(curl -s -X POST "$ENDPOINT" \
    -H "Content-Type: application/json" \
    -d "{\"url\":\"$TEST_URL\"}")

echo "Réponse backend : $RESPONSE"

# Vérifier que la clé short_url est présente
echo "$RESPONSE" | grep -q "short_url"
if [ $? -eq 0 ]; then
    echo "Test backend réussi !"
    exit 0
else
    echo "Test backend échoué : short_url non trouvée."
    exit 1
fi
