package com.example.arrosage;

public class Vanne {

    private String id;
    private String heureDebut;
    private String heureFin;
    private String date;


    public Vanne(String id, String heureDebut, String heureFin, String date) {
        this.id = id;
        this.heureDebut = heureDebut;
        this.heureFin = heureFin;
        this.date = date;
    }
    public Vanne(){}

    public Vanne(String heureDebut, String heureFin, String date) {
        this.heureDebut = heureDebut;
        this.heureFin = heureFin;
        this.date = date;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getHeureDebut() {
        return heureDebut;
    }

    public void setHeureDebut(String heureDebut) {
        this.heureDebut = heureDebut;
    }

    public String getHeureFin() {
        return heureFin;
    }

    public void setHeureFin(String heureFin) {
        this.heureFin = heureFin;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }
}
