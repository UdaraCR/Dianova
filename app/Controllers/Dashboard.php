<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new \App\Models\SugarModel();

        $Id = session()->get('id');

        $readings = $model->where('user_id', $Id)->findAll();

        $total = count($readings);

        $average = 0;
        if ($total > 0) {
            $sum = array_sum(array_column($readings, 'level'));
            $average = round($sum / $total, 2);
        }

        $latest = $total > 0 ? end($readings)['level'] : 'No data';

        return view('dashboard/admin', [
            'total' => $total,
            'average' => $average,
            'latest' => $latest
        ]);
    }

    public function sugar()
    {
        $model = new \App\Models\SugarModel();

        $data['sugarData'] = $model
            ->where('user_id', session()->get('id'))
            ->orderBy('recorded_at', 'DESC')
            ->findAll();

        return view('dashboard/sugar', $data);
    }

    public function store()
    {
        $model = new \App\Models\SugarModel();

        $data = [
            'user_id' => session()->get('id'),
            'level' => $this->request->getPost('level'),
            'recorded_at' => $this->request->getPost('recorded_at'),
        ];

        $model->save($data);

        return redirect()->to('/dashboard/sugar')->with('success', 'Sugar reading added successfully.');
    }

    public function edit($id)
    {
        $model = new \App\Models\SugarModel();

        $reading = $model->find($id);

        if (!reading || $reading['user_id'] != session()->get('id')) {
            return redirect()->to('/dashboard/sugar')->with('error', 'Sugar reading not found.');
        }

        return view('dashboard/edit_sugar', ['reading' => $reading]);
    }

    public function update($id)
    {
        $model = new \App\Models\SugarModel();
        $reading = $model->find($id);

        if (!reading || $reading['user_id'] != session()->get('id')) {
            return redirect()->to('/dashboard/sugar')->with('error', 'Sugar reading not found.');
        }

        $data = [
            'level' => $this->request->getPost('level'),
            'recorded_at' => $this->request->getPost('recorded_at'),
        ];

        $model->update($id, $data);

        return redirect()->to('/dashboard/sugar')->with('success', 'Sugar reading updated successfully.');
    }

    public function delete($id)
    {
        $model = new \App\Models\SugarModel();
        $reading = $model->find($id);

        if (!reading || $reading['user_id'] != session()->get('id')) {
            return redirect()->to('/dashboard/sugar')->with('error', 'Sugar reading not found.');
        }

        $model->delete($id);

        return redirect()->to('/dashboard/sugar')->with('success', 'Sugar reading deleted successfully.');
    }

    public function nutrition()
    {
        $query = trim((string) $this->request->getGet('q'));
        $results = [];
        $error = null;

        if ($query !== '') {
            $apiKey = env('API_KEY') ?: 'DEMO_KEY';
            $url = 'https://api.nal.usda.gov/fdc/v1/foods/search?query=' . urlencode($query) . '&pageSize=10&api_key=' . urlencode($apiKey);

            try {
                $response = @file_get_contents($url);

                if ($response === false) {
                    $error = 'Unable to fetch nutrition data from USDA API.';
                } else {
                    $json = json_decode($response, true);

                    if (!empty($json['foods'])) {
                        foreach ($json['foods'] as $food) {
                            $nutrients = [
                                'calories' => 'N/A',
                                'carbs'    => 'N/A',
                                'sugar'    => 'N/A',
                                'protein'  => 'N/A',
                                'fat'      => 'N/A',
                            ];

                            if (!empty($food['foodNutrients'])) {
                                foreach ($food['foodNutrients'] as $nutrient) {
                                    $name = strtolower($nutrient['nutrientName'] ?? '');
                                    $value = $nutrient['value'] ?? 'N/A';

                                    if (str_contains($name, 'energy')) {
                                        $nutrients['calories'] = $value;
                                    } elseif (str_contains($name, 'carbohydrate')) {
                                        $nutrients['carbs'] = $value;
                                    } elseif (str_contains($name, 'sugars')) {
                                        $nutrients['sugar'] = $value;
                                    } elseif (str_contains($name, 'protein')) {
                                        $nutrients['protein'] = $value;
                                    } elseif ($name === 'total lipid (fat)' || str_contains($name, 'fat')) {
                                        $nutrients['fat'] = $value;
                                    }
                                }
                            }

                            $results[] = [
                                'name'     => $food['description'] ?? 'Unknown food',
                                'brand'    => $food['brandOwner'] ?? '-',
                                'calories' => $nutrients['calories'],
                                'carbs'    => $nutrients['carbs'],
                                'sugar'    => $nutrients['sugar'],
                                'protein'  => $nutrients['protein'],
                                'fat'      => $nutrients['fat'],
                            ];
                        }
                    } else {
                        $error = 'No food results found.';
                    }
                }
            } catch (\Throwable $e) {
                $error = 'Something went wrong while fetching nutrition data.';
            }
        }

        return view('dashboard/nutrition', [
            'query'   => $query,
            'results' => $results,
            'error'   => $error
        ]);
    }

   public function nutritionSuggest()
    {
        $term = trim((string) $this->request->getGet('term'));

        if ($term === '') {
            return $this->response->setJSON([]);
        }

        $apiKey = env('FDC_API_KEY') ?: 'DEMO_KEY';
        $url = 'https://api.nal.usda.gov/fdc/v1/foods/search?query=' . urlencode($term) . '&pageSize=5&api_key=' . urlencode($apiKey);

        $suggestions = [];

        try {
            $response = @file_get_contents($url);

            if ($response === false) {
                return $this->response->setJSON([]);
            }

            $json = json_decode($response, true);

            if (!empty($json['foods'])) {
                foreach ($json['foods'] as $food) {
                    if (!empty($food['description'])) {
                        $suggestions[] = [
                            'label' => $food['description'],
                            'value' => $food['description']
                        ];
                    }
                }
            }
        } catch (\Throwable $e) {
            return $this->response->setJSON([]);
        }

        return $this->response->setJSON($suggestions);
    }

    public function exercise()
    {
        return view('dashboard/exercise');
    }

    public function medication()
    {
        return view('dashboard/medication');
    }  

    public function healthAdvice()
    {
        return view('dashboard/healthAdvice');
    }
}