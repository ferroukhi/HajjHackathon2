package com.epatientcare.hajjhackathon.epatientcare;

import android.app.IntentService;
import android.content.Intent;
import android.util.Log;

import org.json.JSONObject;


/**
 * An {@link IntentService} subclass for handling asynchronous task requests in
 * a service on a separate handler thread.
 * <p>
 * TODO: Customize class - update intent actions and extra parameters.
 */
public class GetPatientInformation extends IntentService {

    String URL_IP = "http://localhost/epatientcare/getPatientInfoMobile.php?patient=";
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

    Database db;

    public GetPatientInformation() {
        super("GetPatientInformation");
    }

    @Override
    protected void onHandleIntent(Intent intent) {

        db = new Database(getApplicationContext());
        db.open();

        String idPatient = intent.getStringExtra("idpatient");
        URL_IP = URL_IP + idPatient;

        try
        {
            // Creating JSON Parser object
            JSONParser jParser = new JSONParser();
            JSONObject object = jParser.getJSONFromUrl(URL_IP);

            String isGood = object.getString(TAG_SUCCESS);
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

        }
        catch (Exception e)
        {
            Log.i("ErrorParsingIpGlobal",""+e);
        }
    }


}
