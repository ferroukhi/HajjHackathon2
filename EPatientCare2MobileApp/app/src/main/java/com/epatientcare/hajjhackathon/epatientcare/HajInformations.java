package com.epatientcare.hajjhackathon.epatientcare;

import android.database.Cursor;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

public class HajInformations extends AppCompatActivity {

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
        patient.moveToFirst();
        country.setText(patient.getString(0));
        passeport.setText("");
        firstname.setText("");
        lastname.setText("");
        age.setText("");
        gender.setText("");
        height.setText("");
        weight.setText("");
        blood.setText("");

    }
}
