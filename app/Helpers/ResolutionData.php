<?php

if (!function_exists('ResolutionData')) {
    function resolutionData($request)
    {
        $documentType = $request->document_type_id;
        $data = [
            "type_document_id" => $documentType,
            "prefix" => $request->get('prefix'),
            "from" => $request->get('start_number'),
            "to" => $request->get('end_number')
        ];

        if ($documentType == 1 || $documentType == 11 || $documentType == 15) {
            $resolutionData = [
                "resolution" => $request->get('resolution'),
                "resolution_date" => $request->get('resolution_date'),
                "generated_to_date" => $request->get('consecutive'),
                "date_from" => $request->get('start_date'),
                "date_to" => $request->get('end_date'),
            ];

            $data = array_merge($data, $resolutionData);

            if ($documentType == 1) {
                $technicalData = [
                    "technical_key" => $request->get('technical_key'),
                ];

                $data = array_merge($data, $technicalData);
            }
        }

        return $data;
    }
}
