# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
  It is possible to retrieve directors using the api
  As a api client

  Scenario:
    When I request "GET" to "/directors"
    Then The response code is "200"
    And  The response body contains
    """
    {
      "@context": "/contexts/Director",
      "@id": "/directors",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@type": "Director",
          "@id": "/directors/01790a60-74a5-c26a-10ee-af0c61fce2af",
          "id": "01790a60-74a5-c26a-10ee-af0c61fce2af",
          "name": {
            "name": "Martin",
            "lastName": "Scorsese"
          },
          "movies": [
            {
              "id": "01790a60-76ee-d7ef-2102-064a03d15b3c",
              "title": "episodio 1",
              "year": 1983,
              "genres": []
            },
            {
              "id": "01790a60-7734-5572-9020-209597ac7d6f",
              "title": "episodio 2",
              "year": 2012,
              "genres": []
            },
            {
              "id": "01790a60-77c5-2340-901b-415d1e5aca9a",
              "title": "episodio 7",
              "year": 1973,
              "genres": []
            }
          ]
        },
        {
          "@type": "Director",
          "@id": "/directors/01790a60-7652-ee91-6f05-89f025968fc1",
          "id": "01790a60-7652-ee91-6f05-89f025968fc1",
          "name": {
            "name": "Steven",
            "lastName": "Spielberg"
          },
          "movies": [
            {
              "id": "01790a60-773c-c589-c9ca-83daebe52d57",
              "title": "episodio 4",
              "year": 2011,
              "genres": []
            },
            {
              "id": "01790a60-77cf-4d61-cc3b-4f03d75b6820",
              "title": "episodio 9",
              "year": 2010,
              "genres": []
            }
          ]
        },
        {
          "@type": "Director",
          "@id": "/directors/01790a60-7655-995e-5663-c53b85f8daf9",
          "id": "01790a60-7655-995e-5663-c53b85f8daf9",
          "name": {
            "name": "Christopher",
            "lastName": "Nolan"
          },
          "movies": [
            {
              "id": "01790a60-77cb-fda1-d5ce-82e527744f0f",
              "title": "episodio 8",
              "year": 1994,
              "genres": []
            }
          ]
        },
        {
          "@type": "Director",
          "@id": "/directors/01790a60-7658-7224-465a-8ab81dd6ec7d",
          "id": "01790a60-7658-7224-465a-8ab81dd6ec7d",
          "name": {
            "name": "David",
            "lastName": "Fincher"
          },
          "movies": [
            {
              "id": "01790a60-7738-008e-53a7-3fd8ff5bc4bd",
              "title": "episodio 3",
              "year": 1984,
              "genres": []
            },
            {
              "id": "01790a60-7741-854e-b39e-d5de36d9b4b3",
              "title": "episodio 5",
              "year": 2013,
              "genres": []
            }
          ]
        },
        {
          "@type": "Director",
          "@id": "/directors/01790a60-765b-98a9-a177-d0141b51c5cc",
          "id": "01790a60-765b-98a9-a177-d0141b51c5cc",
          "name": {
            "name": "Denis",
            "lastName": "Villeneuve"
          },
          "movies": [
            {
              "id": "01790a60-7745-0e84-1517-2f14b12e1aec",
              "title": "episodio 6",
              "year": 1988,
              "genres": []
            }
          ]
        }
      ],
      "hydra:totalItems": 5
    }
    """
