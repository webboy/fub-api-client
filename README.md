# FollowUpBoss API Client
PHP api client library for Follow Up Boss service

## Install
`composer require webboy/fub-api-client`

## Configuration

Use `.env` file to store configuration constants:

`FUB_API_KEY` - Your API key. It can be obtained from FollowUpBoss dashboard.

`FUB_ORIGIN` - Origin string for setting up Email Campaigns (emCampaigns).

## Usage

There are 4 basic methods you can use and they depend on the endpoint. 4 basic methods are:
### index($query_params)
GET method that will list entities

### show($id)
GET method that will retrieve data of a single entity. Requires `$id` to be provided

###create($data)
POST method that will create an entity using the data provided in the `$data` parameter

###update($id,$data)
PUT method that will update the entity identified with `$id` using data provided in `$data` parameter

###remove($id)
DELETE method that will delete the entity identified with `$id`

## Example 1

```$xslt
$client = new Webboy\FubApiClient\Endpoints\Events();
$query_params['limit'] = 15;
$response = $client->index($query_params);
```

Following code will produce an array:

```$xslt
array:15 [▼
  0 => array:13 [▼
    "id" => 1433
    "created" => "2017-09-06T15:29:37Z"
    "updated" => "2017-09-06T15:29:37Z"
    "personId" => 373
    "message" => ""
    "description" => ""
    "noteId" => null
    "source" => "<unspecified>"
    "type" => "Viewed Page"
    "pageTitle" => "Home Page"
    "pageUrl" => "http://ikstrim.net/dev/godzilla-polish-live/"
    "pageDuration" => 0
    "property" => null
  ]
  1 => array:13 [▶]
  2 => array:13 [▶]
  3 => array:13 [▶]
  4 => array:13 [▶]
  5 => array:13 [▶]
  6 => array:13 [▶]
  7 => array:13 [▶]
  8 => array:13 [▶]
  9 => array:13 [▶]
  10 => array:13 [▶]
  11 => array:13 [▶]
  12 => array:13 [▶]
  13 => array:13 [▶]
  14 => array:13 [▶]
]
```