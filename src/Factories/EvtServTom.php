<?php

namespace NFePHP\EFDReinf\Factories;

/**
 * Class EFD-Reinf EvtServTom Event R-2010 constructor
 *
 * @category  Library
 * @package   NFePHP\EFDReinf
 * @copyright NFePHP Copyright (c) 2017 - 2021
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-efdreinf for the canonical source repository
 */

use NFePHP\EFDReinf\Common\Factory;
use NFePHP\EFDReinf\Common\FactoryInterface;
use NFePHP\EFDReinf\Common\FactoryId;
use NFePHP\Common\Certificate;
use stdClass;

class EvtServTom extends Factory implements FactoryInterface
{
    /**
     * Constructor
     * @param string $config
     * @param stdClass $std
     * @param Certificate $certificate
     * @param string $data
     */
    public function __construct(
        $config,
        stdClass $std,
        Certificate $certificate = null,
        $data = ''
    ) {
        $params = new \stdClass();
        $params->evtName = 'evtTomadorServicos';
        $params->evtTag = 'evtServTom';
        $params->evtAlias = 'R-2010';
        parent::__construct($config, $std, $params, $certificate, $data);
    }

    /**
     * Node constructor
     */
    protected function toNode()
    {
        $ideContri = $this->node->getElementsByTagName('ideContri')->item(0);
        //o idEvento pode variar de evento para evento
        //então cada factory individualmente terá de construir o seu
        $ideEvento = $this->dom->createElement("ideEvento");
        $this->dom->addChild(
            $ideEvento,
            "indRetif",
            $this->std->indretif,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "nrRecibo",
            !empty($this->std->nrrecibo) ? $this->std->nrrecibo : null,
            false
        );
        $this->dom->addChild(
            $ideEvento,
            "perApur",
            $this->std->perapur,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "tpAmb",
            $this->tpAmb,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "procEmi",
            $this->procEmi,
            true
        );
        $this->dom->addChild(
            $ideEvento,
            "verProc",
            $this->verProc,
            true
        );
        $this->node->insertBefore($ideEvento, $ideContri);

        $info = $this->dom->createElement("infoServTom");
        $ideEstabObra = $this->dom->createElement("ideEstabObra");
        $this->dom->addChild(
            $ideEstabObra,
            "tpInscEstab",
            $this->std->tpinscestab,
            true
        );
        $this->dom->addChild(
            $ideEstabObra,
            "nrInscEstab",
            $this->std->nrinscestab,
            true
        );
        $this->dom->addChild(
            $ideEstabObra,
            "indObra",
            $this->std->indobra,
            true
        );
        $idePrestServ = $this->dom->createElement("idePrestServ");
        $this->dom->addChild(
            $idePrestServ,
            "cnpjPrestador",
            $this->std->cnpjprestador,
            true
        );
        $this->dom->addChild(
            $idePrestServ,
            "vlrTotalBruto",
            number_format($this->std->vlrtotalbruto, 2, ',', ''),
            true
        );
        $this->dom->addChild(
            $idePrestServ,
            "vlrTotalBaseRet",
            number_format($this->std->vlrtotalbaseret, 2, ',', ''),
            true
        );
        $this->dom->addChild(
            $idePrestServ,
            "vlrTotalRetPrinc",
            number_format($this->std->vlrtotalretprinc, 2, ',', ''),
            true
        );
        $this->dom->addChild(
            $idePrestServ,
            "vlrTotalRetAdic",
            !empty($this->std->vlrtotalretadic) ? number_format($this->std->vlrtotalretadic, 2, ',', '') : null,
            false
        );
        $this->dom->addChild(
            $idePrestServ,
            "vlrTotalNRetPrinc",
            !empty($this->std->vlrtotalnretprinc) ? number_format($this->std->vlrtotalnretprinc, 2, ',', '') : null,
            false
        );
        $this->dom->addChild(
            $idePrestServ,
            "vlrTotalNRetAdic",
            !empty($this->std->vlrtotalnretadic) ? number_format($this->std->vlrtotalnretadic, 2, ',', '') : null,
            false
        );
        $this->dom->addChild(
            $idePrestServ,
            "indCPRB",
            $this->std->indcprb,
            true
        );
        foreach ($this->std->nfs as $n) {
            $nfs = $this->dom->createElement("nfs");
            $this->dom->addChild(
                $nfs,
                "serie",
                $n->serie,
                true
            );
            $this->dom->addChild(
                $nfs,
                "numDocto",
                $n->numdocto,
                true
            );
            $this->dom->addChild(
                $nfs,
                "dtEmissaoNF",
                $n->dtemissaonf,
                true
            );
            $this->dom->addChild(
                $nfs,
                "vlrBruto",
                number_format($n->vlrbruto, 2, ',', ''),
                true
            );
            $this->dom->addChild(
                $nfs,
                "obs",
                !empty($n->obs) ? $n->obs : null,
                false
            );
            foreach ($n->infotpserv as $its) {
                $infoTpServ = $this->dom->createElement("infoTpServ");
                $this->dom->addChild(
                    $infoTpServ,
                    "tpServico",
                    $its->tpservico,
                    true
                );
                $this->dom->addChild(
                    $infoTpServ,
                    "vlrBaseRet",
                    number_format($its->vlrbaseret, 2, ',', ''),
                    true
                );
                $this->dom->addChild(
                    $infoTpServ,
                    "vlrRetencao",
                    number_format($its->vlrretencao, 2, ',', ''),
                    true
                );
                $this->dom->addChild(
                    $infoTpServ,
                    "vlrRetSub",
                    !empty($its->vlrretsub) ? number_format($its->vlrretsub, 2, ',', '') : null,
                    false
                );
                $this->dom->addChild(
                    $infoTpServ,
                    "vlrNRetPrinc",
                    !empty($its->vlrnretprinc) ? number_format($its->vlrnretprinc, 2, ',', '') : null,
                    false
                );
                $this->dom->addChild(
                    $infoTpServ,
                    "vlrServicos15",
                    !empty($its->vlrservicos15) ? number_format($its->vlrservicos15, 2, ',', '') : null,
                    false
                );
                $this->dom->addChild(
                    $infoTpServ,
                    "vlrServicos20",
                    !empty($its->vlrservicos20) ? number_format($its->vlrservicos20, 2, ',', '') : null,
                    false
                );
                $this->dom->addChild(
                    $infoTpServ,
                    "vlrServicos25",
                    !empty($its->vlrservicos25) ? number_format($its->vlrservicos25, 2, ',', '') : null,
                    false
                );
                $this->dom->addChild(
                    $infoTpServ,
                    "vlrAdicional",
                    !empty($its->vlradicional) ? number_format($its->vlradicional, 2, ',', '') : null,
                    false
                );
                $this->dom->addChild(
                    $infoTpServ,
                    "vlrNRetAdic",
                    !empty($its->vlrnretadic) ? number_format($its->vlrnretadic, 2, ',', '') : null,
                    false
                );
                $nfs->appendChild($infoTpServ);
            }
            $idePrestServ->appendChild($nfs);
        }

        if (!empty($this->std->infoprocretpr)) {
            foreach ($this->std->infoprocretpr as $irp) {
                $infoProcRetPr = $this->dom->createElement("infoProcRetPr");
                $this->dom->addChild(
                    $infoProcRetPr,
                    "tpProcRetPrinc",
                    $irp->tpprocretprinc,
                    true
                );
                $this->dom->addChild(
                    $infoProcRetPr,
                    "nrProcRetPrinc",
                    $irp->nrprocretprinc,
                    true
                );
                $this->dom->addChild(
                    $infoProcRetPr,
                    "codSuspPrinc",
                    !empty($irp->codsuspprinc) ? $irp->codsuspprinc : null,
                    false
                );
                $this->dom->addChild(
                    $infoProcRetPr,
                    "valorPrinc",
                    number_format($irp->valorprinc, 2, ',', ''),
                    true
                );
                $idePrestServ->appendChild($infoProcRetPr);
            }
        }
        if (!empty($this->std->infoprocretad)) {
            foreach ($this->std->infoprocretad as $rad) {
                $infoProcRetAd = $this->dom->createElement("infoProcRetAd");
                $this->dom->addChild(
                    $infoProcRetAd,
                    "tpProcRetAdic",
                    $rad->tpprocretadic,
                    true
                );
                $this->dom->addChild(
                    $infoProcRetAd,
                    "nrProcRetAdic",
                    $rad->nrprocretadic,
                    true
                );
                $this->dom->addChild(
                    $infoProcRetAd,
                    "codSuspAdic",
                    !empty($rad->codsuspadic) ? $rad->codsuspadic : null,
                    false
                );
                $this->dom->addChild(
                    $infoProcRetAd,
                    "valorAdic",
                    number_format($rad->valoradic, 2, ',', ''),
                    true
                );
                $idePrestServ->appendChild($infoProcRetAd);
            }
        }
        $ideEstabObra->appendChild($idePrestServ);
        $info->appendChild($ideEstabObra);
        $this->node->appendChild($info);
        $this->reinf->appendChild($this->node);
        //$this->xml = $this->dom->saveXML($this->reinf);
        $this->sign($this->evtTag);
    }
}
