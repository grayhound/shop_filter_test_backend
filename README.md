# ShopFilterTestBackend

## GET query example:
http://localhost:8000/api/catalog/987698cc-c796-4cf3-846c-cd4c3f043bb6/products?filter[987698cc-8fea-439b-9cba-2d384d0b71c4][]=987698cc-985f-483d-b758-23bc84b97832&filter[987698cc-929f-48ad-bb7c-ead200169b68][]=987698cc-99f2-4fec-96d6-b3e9376732c2&filter[987698cc-929f-48ad-bb7c-ead200169b68][]=987698cc-9c28-43b3-a98d-0ac116eecfa5&filter[987698cc-9374-4f99-8ad2-cb2ecbea72ff][]=987698cc-a333-4c8b-9b81-e7498a291986

# Conclusion
This filtering is quite possible and counting just once is fine.

With some caching it will work really fast.

But it's still better to run solution like "Meilisearch" or similar.