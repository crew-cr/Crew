
/**
 * @param queryString
 * @param url for test purpose
 */
url = function(queryString, url)
{
  if(url == undefined)
  {
    url = document.URL;
  }
  
  var root = url.replace(/\.php(.*)$/, '.php/');
  return root+queryString;
};

/**
 * @param key
 * @param url
 */
url.getParameter = function(key, replaceValue, url)
{
  if(typeof key == 'undefined' || key == '' || key == null)
  {
    return '';
  }

  if(typeof url == 'undefined' || url == '' || url == null)
  {
    url = document.URL;
  }

  if(typeof replaceValue == 'undefined')
  {
    replaceValue = '';
  }

  //nice url : foo/bar/id/3
  var regexpNice = '(?:\\?|&)'+key+'=([^\\/?&]+)';
  //regular url foo/bar?id=3&bidule=chose
  var regexpRegular = '\\/'+key+'\\/([^\\/?&]+)';
  var regexp = eval('/'+regexpNice+'|'+regexpRegular+'/');
  var result = regexp.exec(url);

  if(result !== null)
  {
    if(result[2] !== undefined)
    {
      return result[2];
    }
    if(result[1] !== undefined)
    {
      return result[1];
    }
  }

  return replaceValue;
};