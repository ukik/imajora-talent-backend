
<?php

if (!function_exists('person_in_charge')) {
    function person_in_charge()
    {
        return "
            id,
            uuid,
            user_id,
            company_id,
            trans_exam_id,
            person_in_charge_kana_company_name,
            person_in_charge_company_name,
            person_in_charge_postal_code,
            person_in_charge_telephone_number,
            person_in_charge_mobile_phone_number,
            person_in_charge_manager_name,
            person_in_charge_address,
            person_in_charge_email,
            person_in_charge_branch_name,
            person_in_charge_affiliation_name,
            person_in_charge_fax_number,
            person_in_charge_send_report_by_email,
            person_in_charge_send_report_by_email_email1,
            person_in_charge_send_report_by_email_email2,
            person_in_charge_send_report_by_email_email3,
            label,
            created_at,
            updated_at,
            deleted_at
        ";
    }
}

if (!function_exists('construction')) {
    function construction()
    {
        return "
            id,
            uuid,
            user_id,
            company_id,
            trans_exam_id,
            construction_name,
            #construction_name_period_label,
            construction_name_period,
            construction_name_to_the_report,
            construction_examination_body_collection_full_name,
            construction_examination_body_collection_company_name,
            construction_construction_area,
            construction_construction_area_other_select,
            construction_classification_category,
            #construction_architectural_confirmation_number,
            #construction_plan_notification_number,
            construction_architectural_confirmation_plan_notification_1,
            construction_architectural_confirmation_plan_notification_2,
            construction_building_construction_plan_1,
            construction_building_construction_plan_2,
            construction_identification_item,
            construction_constructor_name,
            construction_identification_number,
            construction_name_to_the_report_other,
            construction_architectural_confirmation_or_plan_notification,
            label,
            created_at,
            updated_at,
            deleted_at
        ";
    }
}

if (!function_exists('exam_request')) {
    function exam_request()
    {
        return "
            id,
            uuid,
            user_id,
            company_id,
            trans_exam_id,
            exam_request_company_name,
            exam_request_branch_name,
            exam_request_department_affiliation_name,
            #exam_request_application_company_code___,
            exam_request_postal_code,
            exam_request_address,
            exam_request_fax_number,
            exam_request_kana_company_name,
            exam_request_company_type,
            exam_request_company_type_others,
            exam_request_telephone_number,
            exam_request_manager_name,
            exam_request_email,
            exam_request_destination_information,
            label,
            created_at,
            updated_at,
            deleted_at
        ";
    }
}
