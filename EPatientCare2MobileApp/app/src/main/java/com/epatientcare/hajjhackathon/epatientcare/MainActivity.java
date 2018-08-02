package com.epatientcare.hajjhackathon.epatientcare;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.ActivityNotFoundException;
import android.content.DialogInterface;
import android.content.Intent;
import android.net.Uri;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.SimpleAdapter;
import android.widget.Toast;

import org.json.JSONObject;

public class MainActivity extends AppCompatActivity {

    ImageView qrCodeScan;
    static final String ACTION_SCAN = "com.google.zxing.client.android.SCAN";
    // Progress Dialog
    private ProgressDialog pDialog;
    String URL_IP = "http://192.168.43.77/epatientcare/getPatientInfoMobile.php?patient=";
    private static final String TAG_SUCCESS = "success";
    private static final String TAG_COUNTRY = "country";
    private static final String TAG_PASSPORT = "passeportnumber";
    private static final String TAG_FIRSTNAME = "firstname";
    private static final String TAG_LASTNAME = "lastname";
    private static final String TAG_AGE = "age";
    private static final String TAG_GENDER = "gender";
    private static final String TAG_HEIGHT = "height";
    private static final String TAG_WEIGHT = "weight";
    private static final String TAG_BLOOD = "blood";
    String idPatient = "";

    Database db;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        qrCodeScan = (ImageView) findViewById(R.id.scancodeqr);

        qrCodeScan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                qrCodeRequest();
            }
        });
    }

    public void qrCodeRequest()
    {
        try
        {
            Intent intent = new Intent(ACTION_SCAN);
            intent.putExtra("SCAN_MODE", "QR_CODE_MODE");
            startActivityForResult(intent, 0);
        }
        catch (ActivityNotFoundException anfe)
        {
            showDialog(MainActivity.this, "No Scanner Found", "Download a scanner code activity?", "Yes", "No").show();
        }
    }

    private static AlertDialog showDialog(final Activity act, CharSequence title, CharSequence message, CharSequence buttonYes, CharSequence buttonNo) {
        AlertDialog.Builder downloadDialog = new AlertDialog.Builder(act);
        downloadDialog.setTitle(title);
        downloadDialog.setMessage(message);
        downloadDialog.setPositiveButton(buttonYes, new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialogInterface, int i) {
                Uri uri = Uri.parse("market://search?q=pname:" + "com.google.zxing.client.android");
                Intent intent = new Intent(Intent.ACTION_VIEW, uri);
                try {
                    act.startActivity(intent);
                } catch (ActivityNotFoundException anfe) {

                }
            }
        });
        downloadDialog.setNegativeButton(buttonNo, new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialogInterface, int i) {
            }
        });
        return downloadDialog.show();
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (resultCode == RESULT_OK) {
            if (data.getStringExtra("SCAN_RESULT") != null) {

                String contents = data.getStringExtra("SCAN_RESULT");
                String format = data.getStringExtra("SCAN_RESULT_FORMAT");
                Toast.makeText(getApplicationContext(), ""+contents,Toast.LENGTH_LONG).show();
                idPatient = contents;
                new getPatientInfo().execute();
            }
        }
    }

    class getPatientInfo extends AsyncTask<String, String, String> {
        String isGood = "";
        /**
         * Before starting background thread Show Progress Dialog
         * */
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            Log.i("testOfAccess", "OuiPre");
            pDialog = new ProgressDialog(MainActivity.this);
            pDialog.setMessage("Loading informations. Please wait...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }

        /**
         * getting All products from url
         * */
        protected String doInBackground(String... args) {
            Log.i("testOfAccess", "Oui");
            URL_IP = URL_IP + idPatient;

            try
            {
                // Creating JSON Parser object
                JSONParser jParser = new JSONParser();
                JSONObject object = jParser.getJSONFromUrl(URL_IP);

                isGood = object.getString(TAG_SUCCESS);
                if(isGood.equals("1"))
                {
                    String country = object.getString(TAG_COUNTRY);
                    String passeportnumber = object.getString(TAG_PASSPORT);
                    String firstname = object.getString(TAG_FIRSTNAME);
                    String lastname = object.getString(TAG_LASTNAME);
                    String age = object.getString(TAG_AGE);
                    String gender = object.getString(TAG_GENDER);
                    String height = object.getString(TAG_HEIGHT);
                    String weight = object.getString(TAG_WEIGHT);
                    String blood = object.getString(TAG_BLOOD);

                    db.deleteAllTableRow("patient");
                    db.insererPatient(country, passeportnumber, firstname, lastname, age, gender, height, weight, blood);
                }
                else
                {
                    Toast.makeText(getApplicationContext(), "This haj content doesn't exist in our database",Toast.LENGTH_LONG).show();
                }

            }
            catch (Exception e)
            {
                Log.i("testOfAccess", "Oui2");
                Log.i("ErrorParsingIpGlobal",""+e);
            }
            return null;
        }

        /**
         * After completing background task Dismiss the progress dialog
         * **/
        protected void onPostExecute(String file_url) {
            // dismiss the dialog after getting all products
            pDialog.dismiss();

            if(isGood.equals("1"))
            {
                Intent in = new Intent(getApplicationContext(), HajInformations.class);
                startActivity(in);
            }
            else
            {
                Log.i("testOfAccess", "Oui3");
            }
        }

    }
}
