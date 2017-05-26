[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/FinancialTimes/functions?utm_source=RapidAPIGitHub_FinancialTimesFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)# FinancialTimes Package
Get financial news, blog posts and articles.
* Domain: [ft.com](https://ft.com)
* Credentials: apiKey

## How to get credentials: 
1. Get apiKey from [https://developer.ft.com/](https://developer.ft.com/)
 
## FinancialTimes.getContentById
Get FT content by id

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Api key
| itemId| String| Item ID

## FinancialTimes.getContentNotifications
Notifications enable you to recognise what has changed recently. In general, when you begin consuming the notification resource, use the current date and time; if you want to consume historical notifications, please contact your support representative. The response includes a list of Notifications, where each Notification resource represents content that has been modified on or after the values provided in the request; and a list of links, containing the url to use in retrieving the next set of results, so that you don't miss any changes.

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Api key
| since | String| The start date and time: any content created, updated or deleted since this date should be returned. A valid since parameter must be supplied, and it must be in RFC3339 date time format, for UTC timezone: e.g. 2017-01-06T10:00:00.000Z The date and time must not be in the future.

## FinancialTimes.getCurationsList
An API endpoint to discover a list of curations that can be specified in search API queries. Curations allow the API consumer to specify a curated set of content and describes the scope against which a Query will operate. It is not a format type.

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Api key

## FinancialTimes.getAspectsList
An API endpoint to discover which aspects can be used in search API queries. Aspects allow the API consumer to specify the aspects of content they wish to be included within their search results.

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Api key

## FinancialTimes.getFacetsList
An API endpoint to discover a list of facets that can be specified in search API queries.

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Api key

## FinancialTimes.searchContent
Search for items of content that are available on www.ft.com.

| Field             | Type  | Description
|-------------------|-------|----------
| apiKey            | credentials| Api key
| queryString       | String| Query to search
| curations         | Array | List of curations. See getCurationsList endpoint for details
| aspects           | Array | List of aspects. See getAspectsList endpoint for details
| maxResults        | Number| Maximum number of results you would like to get. The default and maximum value of maxResults is 100.
| offset            | Number| Zero based offset to specify where results should begin. The default is 0.
| sortOrder         | String| Either ASC for ascending or DESC for descending order.
| sortField         | String| The name of a sortable field.
| facetNames        | String| Facets allow consumers to navigate through their results by refining their query. Facets can be provided in the resultContext:
| facetsMaxElements | Number| facetsMaxElements is the maximum number of facet elements to return (-1 is all facets)
| facetsMinThreshold| Number| facetsMinThreshold is the minimum count required for inclusion.

