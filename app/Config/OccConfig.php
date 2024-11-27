<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class OccConfig extends BaseConfig
{
    // Etat d'une FACTURE
    public $type_id_etat_facture = 3;
    public $occ_facture_ouvert = 11;
    public $occ_facture_envoye = 12;
    public $occ_facture_p_paye = 13;
    public $occ_facture_paye = 25;
    public $occ_facture_avoir = 43;

    // Etat d'un DEVIS
    public $type_id_etat_devis = 4;
    public $occ_devis_ouvert = 15;
    public $occ_devis_envoye = 16;
    public $occ_devis_accepte = 17;
    public $occ_devis_refuse = 18;
    public $occ_devis_facture = 19;

    // Etat d'une COMMANDE
    public $type_id_etat_commande = 5;

    // Moyens de paiement VENTE
    public $type_id_moyens_paiement = 8;
    public $occ_paiement_espece = 24;
    public $occ_paiement_vire = 26;
    public $occ_paiement_cheque = 27;
    public $occ_paiement_ras = 10;
    public $occ_paiement_etraite = 9;

    // TVA en cours
    public $type_id_tva = 9;

    // DEVISE
    public $type_id_devise = 10;
    public $occ_devise_TND = 1;
    public $occ_devise_EURO = 8;

    // Motif des absences salariés
    public $type_id_motif_absence = 17;
    public $occ_absence_cp = 120;
    public $occ_absence_maladie = 121;
    public $occ_absence_non_justifie = 122;

    // Statut des absences salariés
    public $type_id_statut_conges = 21;
    public $occ_conge_accepte = 28;
    public $occ_conge_refuse = 123;

    // Etat AVOIR
    public $type_id_etat_avoir = 25;
    public $occ_avoir_ouvert = 48;
    public $occ_avoir_envoye = 49;
    public $occ_avoir_p_paye = 45;
    public $occ_avoir_paye = 44;

    // Saisie des temps
    public $max_heures_pointees = -1; // Unlimited
    public $type_id_type_ticket = 39;
    public $ticket_projet = "TICKET_PROJET";
    public $ticket_par_defaut = "TICKET_PAR_DEFAUT";

    // Catégorie d'un PROJET
    public $type_id_type_categorie_projet = 38;

    // Statut de ticket
    public $type_id_statut_ticket = 33;

    // Unité de temps d'affichage
    public $type_id_unite_temps = 40;
    public $type_occ_code_unite_temps_jours = "En jours"; // Do not modify in database

    // Etat d'un projet
    public $type_id_etat_projet = 41;
    public $type_occ_code_etat_projet_en_cours = "En cours";
    public $type_occ_code_etat_projet_facture = "Facturé";
    public $type_occ_code_etat_projet_cloture = "Clôturé";

    // Unité articles
    public $type_id_unite = 42;

    // Type d'un ticket (bug, évolution, ...)
    public $type_id_type_tache = 39;

    // Priorité d'un ticket (faible, moyenne, élevée)
    public $type_id_priorite_tache = 45;

    // Etat d'un ticket (En cours, fermé, livré ...)
    public $type_id_etat_tache = 46;
}
