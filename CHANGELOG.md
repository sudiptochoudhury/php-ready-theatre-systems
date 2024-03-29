### Changelog

### 1.0.10 - 12 April 2023
- Revert back Sensory Show FILM_INFO3 constants (was removed by mistake) 
 
### 1.0.9 - 13 May 2022
- Add new FILM_INFO3 constants 
- Support PHP 8

### 1.0.8 - 10 Mar 2020
- Add additional purchase related properties in guzzle operation 

### 1.0.7 - 10 Mar 2020
- Add purchase related properties in guzzle operation 

### 1.0.6.2 - 22 Feb 2020
- Fix Exception handling for SQL API 

### 1.0.6.1 - 22 Feb 2020
- Fix Exception handling for SQL API 

### 1.0.6 - 22 Feb 2020
- Add Exception handling for SQL API 

### 1.0.5 - 6 Feb 2020
- Convert XML string to utf-8 first before converting to XML 

### 1.0.4 - 16 Jan 2020
- Fix for non-standard data format received for single record or single field

### 1.0.3 - 9 Jan 2020
- Fix issue with RTS not supporting CDATA in query.

### 1.0.2 - 9 Jan 2020
- Update docs.

### 1.0.1 - 9 Jan 2020
- Remove seat layout app

### 1.0.0 - 9 Jan 2020
- Add SQL API - `new SqlApi($config)->query($query, $options)` which returns as associative array   
    - $options (array) argument can have  `asString` to return result as string (XML as string).
    - $options (array) argument can have  `asXML` to return result as SimpleXML object.
    - $options (array) argument can have  `asRawArray` to return result as array as converted from SimpleXML object.
- Add `getGiftCardInformationWithPin`
- Add `getTransactionDetails`
- Update error constants  
  
### 0.4.1 - 3 Sep 2019
- Fix release constants

### 0.4.0 - 3 Sep 2019
- Add `probe` and 'isIt' static methods in `Constants` to find properties of movie or showtimes.
- Add `getMessage` static method in `Constants`

### 0.3.8 - 2 Aug 2019
- Updated two more Info3 bits  

### 0.0.1
- Initial release 
