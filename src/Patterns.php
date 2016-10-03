<?php

namespace VasilDakov\Postcode;

final class Patterns
{
    /**
     * Regular expression pattern for Outward code
     */

    const REGEXP_POSTCODE_UKGOV = "/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/";

    /**
     * Regular expression pattern for Outward code
     */
    const REGEXP_POSTCODE     = "/^[A-Za-z]{1,2}\d[a-z\d]?\s*\d[A-Za-z]{2}$/i";


    /**
     * Regular expression pattern for Outward code
     */
    const REGEXP_OUTWARD     = "/\d[A-Za-z]{1,2}$/i";


    /**
     * Regular expression pattern for Inward code
     */
    const REGEXP_INWARD      = "/\d[A-Za-z]{2}$/i";


    /**
     * Regular expression pattern for Area code
     */
    const REGEXP_AREA        = "/^[A-Za-z]{1,2}/i";


    /**
     * Regular expression pattern for Sector code
     */
    const REGEXP_SECTOR      = "/^[A-Za-z]{1,2}\d[A-Za-z\d]?\s*\d/i";


    /**
     * Regular expression pattern for Unit code
     */
    const REGEXP_UNIT        =  "/[A-Za-z]{2}$/i";


    /**
     * Regular expression pattern for District code
     */
    const REGEXP_DISTRICT    = "/^([A-Za-z]{1,2}\d)([A-Za-z])$/i";


    /**
     * Regular expression pattern for Subdistrict code
     */
    const REGEXP_SUBDISTRICT = "/^([A-Za-z]{1,2}\d)([A-Za-z])$/i";
}