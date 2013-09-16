using System;
using System.Collections;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Security.Cryptography;
using System.Runtime.Serialization.Json;
 
class Program
{
  static string DOMAIN = "YOUR_SHOW_DOMAIN";
  static string AUTH_TOKEN = "YOUR_AUTH_TOKEN";
  static string riskified_url = "http://riskified-sandbox.herokuapp.com/webhooks/merchant_order_created";

  static string calcHmac( string data )
  {
    byte[] key = Encoding.ASCII.GetBytes(AUTH_TOKEN);
    HMACSHA256 myhmacsha256 = new HMACSHA256(key);
    byte[] byteArray = Encoding.ASCII.GetBytes(data);
    MemoryStream stream = new MemoryStream(byteArray);
    string result = myhmacsha256.ComputeHash(stream).Aggregate("", (s, e) => s + String.Format("{0:x2}",e), s => s );
    Console.WriteLine(result);
    return result;
  }

  static string getOrderString()
  {
    // Read the file as one string. 
    string json_order_string = System.IO.File.ReadAllText(@"order.json");
    return json_order_string;
  }

  static void doPost( string postData )
  {

    HttpWebRequest request = (HttpWebRequest)WebRequest.Create (riskified_url);
    request.Method = "POST";

    byte[] byteArray = Encoding.UTF8.GetBytes (postData);

    request.ContentType = "application/json";
    request.ContentLength = byteArray.Length;
    request.Accept="*/*";
    
    // Set custom Riskified headers
    string hash_code = calcHmac(postData);
    request.Headers.Add("X_RISKIFIED_HMAC_SHA256",hash_code);
    request.Headers.Add("X_RISKIFIED_SHOP_DOMAIN",DOMAIN);
    request.Headers.Add("Accept-Encoding","gzip,deflate,sdch");

    Stream dataStream = request.GetRequestStream ();
    dataStream.Write (byteArray, 0, byteArray.Length);
    dataStream.Close ();

    // Get the response.
    WebResponse response = request.GetResponse ();
    Console.WriteLine (((HttpWebResponse)response).StatusDescription);
    dataStream = response.GetResponseStream ();
    StreamReader reader = new StreamReader (dataStream);
    string responseFromServer = reader.ReadToEnd ();
    Console.WriteLine (responseFromServer);

    // Clean up the streams.
    reader.Close ();
    dataStream.Close ();
    response.Close ();
  }

  static void Main( string[] args )
  {
    string postData = getOrderString();
    Console.WriteLine(postData);
    doPost(postData);
  }
}

