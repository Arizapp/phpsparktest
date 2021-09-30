<?php


namespace App\Libraries\Admin;


use App\Entities\Imovel;
use App\Entities\SysCity;
use App\Libraries\RouteManager;
use App\Models\SysCities;
use Config\Paths;
use Exception;

class Imoveis
{
    /**
     * @param array $form
     * @throws Exception
     */
    private function preDB(array &$form)
    {
//        d($form);
        if (empty($form['sys_city_id'])) throw new Exception('Cidade obrigatória.');
        if (empty($form['bairro'])) throw new Exception('Bairro obrigatório.');
        if (empty($form['titulo'])) throw new Exception('Título obrigatório.');

        if (!empty($form['valor'])) {
            $form['valor'] = preg_replace('/\D/', '', $form['valor']) / 100;
        }
        $form['telefone'] = preg_replace('/\D/', '', $form['telefone']);
        $form['whatsapp'] = preg_replace('/\D/', '', $form['whatsapp']);
        $form['quartos'] = preg_replace('/\D/', '', $form['quartos']);
        $form['area_construida'] = preg_replace('/\D/', '', $form['area_construida']);
        $form['area_total'] = preg_replace('/\D/', '', $form['area_total']);
        if (empty($form['destaque'])) {
            $form['destaque'] = 0;
        }
        if (empty($form['lancamento'])) {
            $form['lancamento'] = 0;
        }
        if (empty($form['publicado'])) {
            $form['publicado'] = 0;
        }
        /** @var SysCity $cidade */
        $cidade = (new SysCities())->find($form['sys_city_id']);
        $map = ['á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'é' => 'e', 'ê' => 'e', 'í' => 'i',
                'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ú' => 'u', 'ü' => 'u', 'ç' => 'c',
                'Á' => 'A', 'À' => 'A', 'Ã' => 'A', 'Â' => 'A', 'É' => 'E', 'Ê' => 'E', 'Í' => 'I',
                'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ú' => 'U', 'Ü' => 'U', 'Ç' => 'C'];
        $uf = strtolower(strtr($cidade->state->name, $map));
        $cid = strtolower(strtr($cidade->name, $map));
        $bairro = strtolower(strtr($form['bairro'], $map));
        $titulo = strtolower(strtr($form['titulo'], $map));
        $id = $form['id'] ?? '{id}';
        $form['url'] = $uf . '/' . $cid . '/' . url_title($bairro) . '/' . $id . '-' . url_title($titulo);
//        dd($form);
    }

    /**
     * @param array $form
     * @param array $files
     * @return \CodeIgniter\Database\BaseResult|false|int|object|string
     * @throws \ReflectionException
     */
    public function insert(array $form, array $files = [])
    {
        try {
            $this->preDB($form);

            if (!empty($files['foto'])) {
                $imageUploadDirectory = (new Paths())->imageUploadDirectory;
                $img = $files['foto'];
                if ($img->isValid() && !$img->hasMoved()) {
                    $name = $img->getRandomName();
                    $img->move($imageUploadDirectory, $name);
                    $form['foto'] = $name;
                }
            }

            $model = new \App\Models\Imoveis();
            $id = $model->insert($form);
            $record = $model->find($id);
            $record->url = str_replace('{id}', $id, $record->url);
            $model->update($id, $record);

            return $id;
        }
        catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param int   $id
     * @param array $form
     * @param array $files
     * @throws \ReflectionException
     */
    public function update(int $id, array $form, array $files = [])
    {
        try {
            $this->preDB($form);

            if (!empty($files['foto'])) {
                $imageUploadDirectory = (new Paths())->imageUploadDirectory;
                $img = $files['foto'];
                if ($img->isValid() && !$img->hasMoved()) {
                    $name = $img->getRandomName();
                    $img->move($imageUploadDirectory, $name);
                    $form['foto'] = $name;
                }
            }

            $model = new \App\Models\Imoveis();
            $model->update($id, $form);
        }
        catch (Exception $e) {
            throw $e;
        }
    }
}
