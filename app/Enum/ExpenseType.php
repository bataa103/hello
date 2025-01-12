<?php

namespace App\Enum;

enum ExpenseType: string
{
    // Housing
    case RENT_MORTGAGE = 'rent_mortgage';
    case PROPERTY_TAXES = 'property_taxes';
    case HOME_INSURANCE = 'home_insurance';

    // Utilities
    case ELECTRICITY = 'electricity';
    case WATER = 'water';
    case GAS = 'gas';
    case INTERNET_PHONE = 'internet_phone';

    // Transportation
    case CAR_PAYMENT = 'car_payment';
    case GASOLINE_FUEL = 'gasoline_fuel';
    case PUBLIC_TRANSPORTATION = 'public_transportation';
    case CAR_INSURANCE = 'car_insurance';

    // Food
    case GROCERIES = 'groceries';
    case DINING_OUT = 'dining_out';

    // Healthcare
    case HEALTH_INSURANCE = 'health_insurance';
    case DOCTOR_VISITS = 'doctor_visits';
    case PRESCRIPTIONS = 'prescriptions';

    // Personal Care
    case HAIRCUTS_STYLING = 'haircuts_styling';
    case TOILETRIES = 'toiletries';

    // Debt Payments
    case STUDENT_LOANS = 'student_loans';
    case CREDIT_CARD_BILLS = 'credit_card_bills';

    // Entertainment
    case STREAMING_SERVICES = 'streaming_services';
    case HOBBIES = 'hobbies';

    // Clothing
    case APPAREL = 'apparel';

    // Savings
    case EMERGENCY_FUND = 'emergency_fund';
    case RETIREMENT_SAVINGS = 'retirement_savings';
}
