package com.epatientcare.hajjhackathon.epatientcare;

import android.app.ProgressDialog;
import android.content.Intent;
import android.database.Cursor;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;

import org.json.JSONObject;

import static java.lang.Thread.sleep;

public class HajInformations extends AppCompatActivity {

    private ProgressDialog pDialog;
    Database db;
    TextView country, passeport, firstname, lastname, age, gender, height, weight, blood;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_haj_informations);

        db = new Database(getApplicationContext());
        db.open();

        country = (TextView) findViewById(R.id.country);
        passeport = (TextView) findViewById(R.id.passeport);
        firstname = (TextView) findViewById(R.id.firstname);
        lastname = (TextView) findViewById(R.id.lastname);
        age = (TextView) findViewById(R.id.age);
        gender = (TextView) findViewById(R.id.gender);
        height = (TextView) findViewById(R.id.height);
        weight = (TextView) findViewById(R.id.weight);
        blood = (TextView) findViewById(R.id.blood);

        Cursor patient = db.getpathients();
        Log.i("RequestCount", ""+patient.getCount());
        if(patient.getCount() > 0)
        {
            patient.moveToFirst();
            country.setText(patient.getString(1));
            passeport.setText(patient.getString(2));
            firstname.setText(patient.getString(3));
            lastname.setText(patient.getString(4));
            age.setText(patient.getString(5));
            gender.setText(patient.getString(6));
            height.setText(patient.getString(7));
            weight.setText(patient.getString(8));
            blood.setText(patient.getString(9));
        }
    }


}
