import java.io.*;
import java.net.*;
import java.security.*;
import java.util.Scanner;
 
import javax.crypto.Mac;
import javax.crypto.spec.SecretKeySpec;
 
public class WebhookExample {
 
  static String AUTH_TOKEN = <YOUR_AUTH_TOKEN>;
  static String DOMAIN = <YOUR_SHOP_DOMAIN>;
 
  static String riskified_url = "http://sandbox.riskified.com/webhooks/merchant_order_created";
 
  public static void main(String[] args) throws Exception {
    String request = riskified_url;
    URL url = new URL(request);
    HttpURLConnection connection = (HttpURLConnection) url.openConnection();
    connection.setDoOutput(true);
    connection.setDoInput(true);
    connection.setInstanceFollowRedirects(false);
    connection.setRequestMethod("POST");
    connection.setRequestProperty("Content-Type", "application/json");
    connection.setRequestProperty("charset", "utf-8");
    connection.setRequestProperty("Accept", "*/*");
 
    connection.setRequestProperty("Accept-Encoding", "gzip,deflate,sdch");
 
    String body = new Scanner(new File("order.json")).useDelimiter("\\A").next();
 
    connection.setRequestProperty("Content-Length", "" + Integer.toString(body.getBytes().length));
    String hmac = WebhookExample.calculateRFC2104HMAC(body, AUTH_TOKEN);
 
    connection.setRequestProperty("X_RISKIFIED_HMAC_SHA256", hmac);
    connection.setRequestProperty("X_RISKIFIED_SHOP_DOMAIN", DOMAIN);
    connection.setUseCaches(false);
 
    DataOutputStream wr = new DataOutputStream(connection.getOutputStream());
    wr.writeBytes(body);
    wr.flush();
    wr.close();
    BufferedReader response = new BufferedReader(new InputStreamReader(connection.getInputStream()));
    String inputLine;
    while ((inputLine = response.readLine()) != null)
      System.out.println(inputLine);
    response.close();
    connection.disconnect();
  }
 
  public static String calculateRFC2104HMAC(String data, String key) throws SignatureException, NoSuchAlgorithmException,
      InvalidKeyException {
    Mac sha256_HMAC = Mac.getInstance("HmacSHA256");
    SecretKeySpec secret_key = new SecretKeySpec(key.getBytes(), "HmacSHA256");
    sha256_HMAC.init(secret_key);
 
    byte[] bytes = sha256_HMAC.doFinal(data.getBytes());
    return bytesToHex(bytes);
  }
 
  private final static char[] hexArray = "0123456789abcdef".toCharArray();
 
  private static String bytesToHex(byte[] bytes) {
    char[] hexChars = new char[bytes.length * 2];
    int v;
    for (int j = 0; j < bytes.length; j++) {
      v = bytes[j] & 0xFF;
      hexChars[j * 2] = hexArray[v >>> 4];
      hexChars[j * 2 + 1] = hexArray[v & 0x0F];
    }
    return new String(hexChars);
  }
}

