<?php

namespace AppBundle\Entity;

class BusinessType extends Enum
{
    const WHOLESALE_AND_INTERMEDIARY_TRADE                  = 1;  //Торгівля оптова і посередницька
    const REALTOR_ACTIVITY                                  = 2;  //Ріелторська діяльність
    const RETAIL_TRADE                                      = 3;  //Торгівля роздрібна
    const TRANSPORT_COMMUNICATION                           = 4;  //Транспорт, зв'язок
    const INFORMATION_SERVICES_TELECOMMUNICATIONS           = 5;  //Information services, telecommunications
    const AGRICULTURE                                       = 6;  //Сільське господарство
    const LIGHT_AND_FOOD_INDUSTRY                           = 7;  //Легка і харчова промисловість
    const PUBLIC_CATERING_RESTAURANTS                       = 8;  //Громадське харчування, ресторани
    const FINANCE_BANKING_INSURANCE                         = 9;  //Фінанси, банківська справа, страхування
    const MACHINE_BUILDING_METAL_WORKING                    = 10; //Машинобудування, металообробка
    const CHEMISTRY_PERFUMERY_PHARMACEUTICALS               = 11; //Хімія, парфумерія, фармацевтика
    const EDUCATION                                         = 12; //Освіта
    const HEALTHCARE                                        = 13; //Охорона здоров'я
    const CULTURE                                           = 14; //Культура
    const SCIENCE                                           = 15; //Наука
    const LEGAL_NOTARIAL_SERVICES                           = 16; //Юридичні, нотаріальні послуги
    const PRIVATE_DETECTIVE_SECURITY_AGENCY                 = 17; //Приватне детективне / охоронне агентство
    const ENTERTAINING_GAMBLING_SHOW_BUSINESS               = 18; //Розважальний, гральний, шоу-бізнес
    const AUDIT_CONSULTING                                  = 19; //Аудит консалтинг
    const DEVELOPMENT                                       = 20; //Девелопмент
    const CONSTRUCTION                                      = 21; //Будівництво
    const PRODUCTION_OF_BUILDING_MATERIALS                  = 22; //Виробництво будматеріалів
    const EXTRACTION_OF_MINERALS_EXCEPT_FUEL_AND_ENERGY     = 23; //Видобуток корисних копалин, крім ПЕК
    const FUEL_AND_ENERGY                                   = 24; //Видобуток ПЕК корисних копалин
    const MUNICIPAL_ECONOMY                                 = 25; //Комунальне господарство
    const REGIONAL_GOVERNMENT                               = 26; //Органи державного або регіонального управління
    const ARMED_FORCES                                      = 27; //Збройні сили
    const LAW_ENFORCEMENT_AGENCIES_CUSTOMS_TAX_POLICE       = 28; //Правоохоронні органи, митниця, податкова поліція
    const MASS_MEDIA_ADVERTISING_PR_AGENCIES                = 29; //ЗМІ, реклама, PR-агентства
    const PUBLISHING_ACTIVITIES                             = 30; //Видавнича діяльність
    const OTHER                                             = 31; //Інше
}