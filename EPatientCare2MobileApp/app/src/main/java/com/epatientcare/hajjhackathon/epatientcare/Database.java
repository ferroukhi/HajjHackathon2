package com.epatientcare.hajjhackathon.epatientcare;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.widget.Toast;

public class Database {

    SQLiteDatabase db;
    DatabaseHelper	DBHelper;
    Context context;

    public Database(Context context)
    {	this.context = context;
        DBHelper = new DatabaseHelper(context);
    }

    public class DatabaseHelper extends SQLiteOpenHelper {
        Context context;

        //pour créer les tables
        public DatabaseHelper(Context context) {
            super(context, "EpatientCare001", null, 1);
            this.context = context;
        }

        @Override
        public void onCreate(SQLiteDatabase db) {
            // increment pare miois
            db.execSQL("CREATE TABLE IF NOT EXISTS patient("
                    + " _id integer  primary key autoincrement,"
                    + " country text ,"
                    + " passport text ,"
                    + " firstname text ,"
                    + " lastname text,"
                    + " age text,"
                    + " gender text ,"
                    + " height text ,"
                    + " weight text , "
                    + " blood text );");


        }

        @Override
        public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
            Toast.makeText(context, "Mise à jour de la Base de données version "+oldVersion+" vers "+newVersion, Toast.LENGTH_SHORT).show();
            onCreate(db);
        }

    }

    public void insererPatient(String country, String passport, String firstname, String lastname, String age,String gender,
                                 String  height, String weight,String blood )
    {
        ContentValues values = new ContentValues();
        values.put("country", country);
        values.put("passport", passport);
        values.put("firstname", firstname);
        values.put("lastname", lastname);
        values.put("age", age);
        values.put("gender", gender);
        values.put("height", height);
        values.put("weight", weight);
        values.put("blood", blood);
        db.insert("patient", null, values);
    }

    public void deleteAllTableRow(String table)
    {
        db.execSQL("DELETE FROM " + table+ " ");
    }

    public Cursor getpathients()
    {
        return db.rawQuery("SELECT _id, country, passport, firstname, lastname, age, gender, height, weight, blood FROM patient ", null);
    }

    public Database open()
    {	db = DBHelper.getWritableDatabase();
        return this;
    }

    public void close(){
        db.close();
    }
}
