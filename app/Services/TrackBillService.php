<?php

namespace App\Services;

use App\Repositories\TrackBillRepository;
use App\Models\TrackBill;
use Illuminate\Support\Facades\DB;

class TrackBillService
{
    public function __construct(private readonly TrackBillRepository $trackBills) {}

    public function create(array $data): TrackBill
    {
        if (array_key_exists('tags', $data)) {
            $data['tags'] = $this->serializeTags($data['tags']);
        }

        return DB::transaction(fn () => $this->trackBills->create($data));
    }

    private function serializeTags(mixed $rawTags): string
    {
        // normalize về array
        $tags = is_array($rawTags)
            ? $rawTags
            : explode(',', (string) $rawTags);

        // lọc rỗng, trim
        $tags = array_values(array_filter(array_map('trim', $tags)));

        return $tags ? serialize($tags) : 'a:1:{i:0;N;}';
    }
}
