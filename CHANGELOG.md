### Changelog

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
