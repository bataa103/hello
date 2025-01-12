<?php

namespace App\Enum;

enum IncomeType: string
{
    case Цалин = 'Цалин';
    case Урамшуулал = 'Урамшуулал';
    case Хувьцааны_ноогдол_ашиг = 'Хувьцааны ноогдол ашиг';
    case Түрээсийн_орлого = 'Түрээсийн_орлого';
    case Тэтгэвэр = 'Тэтгэвэр';
    case Тэтгэмж = 'Тэтгэмж';
    case Бизнес_орлого = 'Бизнес орлого';
    case Бусад = 'Бусад';
    case Хадгаламжийн_хүү = 'Хадгаламжийн хүү';
    case Хандив = 'Хандив';
    case Уран_бүтээлийн_орлого = 'Уран бүтээлийн орлого';
    case Хөдөлмөрийн_гэрээний_орлого = 'Хөдөлмөрийн гэрээний орлого';
    case Технологийн_орлого = 'Технологийн орлого';
    case Гэрээт_ажлын_орлого = 'Гэрээт ажлын орлого';
    case Цахим_худалдааны_орлого = 'Цахим худалдааны орлого';
    case Аялал_жуулчлалын_орлого = 'Аялал жуулчлалын орлого';
    case Зохиогчийн_эрхийн_орлого = 'Зохиогчийн эрхийн орлого';
}
